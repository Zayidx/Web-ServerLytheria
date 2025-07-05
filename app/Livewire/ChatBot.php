<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Exception;
use Illuminate\Support\Facades\Log;

class ChatBot extends Component
{
    /**
     * Menyimpan riwayat lengkap percakapan.
     * Strukturnya: [['sender' => 'bot', 'content' => '...'], ['sender' => 'user', 'content' => '...']]
     * @var array
     */
    public array $messages = [];

    /**
     * Input teks dari pengguna, di-binding ke form.
     * @var string
     */
    public string $userInput = '';

    /**
     * Method yang dijalankan saat komponen pertama kali dimuat.
     * Menyiapkan pesan sapaan awal dari bot.
     */
    public function mount()
    {
        // Hanya tambahkan pesan sapaan jika riwayat chat kosong
        if (empty($this->messages)) {
            $this->messages[] = [
                'sender' => 'bot',
                'content' => "Halo! Selamat datang di LytheriaSMP. Ada yang bisa saya bantu? Coba tanyakan tentang 'aturan' atau 'ip server'."
            ];
        }
    }

    /**
     * Mengirimkan pesan pengguna dan memicu respons dari AI.
     */
    public function sendMessage()
    {
        // Validasi input pengguna tidak boleh kosong atau hanya spasi
        $trimmedInput = trim($this->userInput);
        if (empty($trimmedInput)) {
            return;
        }

        // 1. Tambahkan pesan pengguna ke riwayat chat agar langsung tampil di UI
        $this->messages[] = ['sender' => 'user', 'content' => $trimmedInput];
        
        // Kosongkan input field di UI
        $this->reset('userInput');

        // 2. Panggil AI untuk mendapatkan balasan
        $this->askGemini($trimmedInput);
    }

    /**
     * Mengirim permintaan ke Google Gemini API dengan riwayat percakapan.
     *
     * @param string $latestQuestion Pertanyaan terakhir dari pengguna.
     */
    protected function askGemini(string $latestQuestion)
    {
        $apiKey = config('services.gemini.api_key');

        // Hentikan proses jika API key tidak ditemukan
        if (!$apiKey) {
            $this->addBotMessage("Kesalahan Konfigurasi: Kunci API untuk layanan AI belum diatur di server. Silakan hubungi administrator.");
            Log::error('GEMINI_API_KEY tidak ditemukan di file .env atau config/services.php');
            return;
        }

        // Instruksi sistem untuk AI
        $systemInstruction = "Anda adalah NexusBot, asisten AI yang ramah untuk server Minecraft bernama \"LytheriaSMP\". Informasi penting tentang server: - Nama Server: LytheriaSMP - IP Server: play.LytheriaSMP.net - Game Mode: Survival RPG, Skyblock Galaxy, dan Creative Plots. - Aturan Utama: 1. Dilarang merusak (griefing). 2. Bersikap sopan. 3. Dilarang curang (cheat). - Discord: Pengguna bisa bergabung melalui tautan di website. Tugas Anda: 1. Jawab pertanyaan pengguna HANYA jika berhubungan dengan Minecraft atau server LytheriaSMP. 2. Jika pertanyaan di luar topik (misalnya tentang cuaca, politik, atau game lain), tolak dengan sopan. Katakan bahwa Anda hanya diprogram untuk menjawab pertanyaan seputar Minecraft dan LytheriaSMP. 3. Berikan jawaban yang singkat, jelas, dan ramah.";

        // Format riwayat pesan sesuai dengan yang dibutuhkan Gemini API
        $formattedMessages = [];
        foreach ($this->messages as $message) {
            // Gemini menggunakan 'model' untuk respons AI dan 'user' untuk input pengguna
            $role = ($message['sender'] === 'bot') ? 'model' : 'user';
            
            // Jangan sertakan pesan error dari bot sebelumnya dalam konteks
            if ($role === 'model' && str_contains($message['content'], 'Kesalahan Konfigurasi')) {
                continue;
            }

            $formattedMessages[] = [
                'role' => $role,
                'parts' => [['text' => $message['content']]]
            ];
        }

        try {
            $response = Http::timeout(60) // Set timeout untuk mencegah request hang
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => $formattedMessages,
                    'system_instruction' => [
                        'parts' => [['text' => $systemInstruction]]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'topK' => 1,
                        'topP' => 1,
                        'maxOutputTokens' => 2048,
                    ],
                ]);
            
            if ($response->successful()) {
                // Menggunakan data_get untuk mengambil data dengan aman, memberikan default jika tidak ada
                $reply = data_get($response->json(), 'candidates.0.content.parts.0.text', "Maaf, saya tidak dapat memberikan jawaban saat ini. Coba lagi nanti.");
                $this->addBotMessage($reply);
            } else {
                // Tangani jika ada error dari API, seperti prompt yang diblokir
                $errorData = $response->json();
                $blockReason = data_get($errorData, 'promptFeedback.blockReason');
                
                if ($blockReason) {
                    $this->addBotMessage("Maaf, pertanyaan Anda tidak dapat saya proses karena alasan keamanan ({$blockReason}). Mohon ajukan pertanyaan lain.");
                } else {
                    $errorMessage = data_get($errorData, 'error.message', 'Terjadi error tidak diketahui dari API.');
                    $this->addBotMessage("Maaf, terjadi masalah saat menghubungi AI. Silakan coba lagi.");
                    Log::error('Gemini API Error: ' . $errorMessage, $errorData);
                }
            }

        } catch (ConnectionException $e) {
            // Tangani error koneksi (misal: tidak ada internet, timeout)
            Log::error('Koneksi ke Gemini API gagal: ' . $e->getMessage());
            $this->addBotMessage("Maaf, terjadi kesalahan koneksi ke server AI. Pastikan koneksi internet Anda stabil dan coba lagi nanti.");
        } catch (Exception $e) {
            // Tangani error umum lainnya
            Log::error('Terjadi kesalahan tak terduga pada ChatBot: ' . $e->getMessage());
            report($e);
            $this->addBotMessage("Maaf, terjadi kesalahan sistem. Kami sedang menanganinya.");
        }
    }

    /**
     * Helper untuk menambahkan pesan dari bot ke riwayat chat.
     *
     * @param string $content Isi pesan dari bot.
     */
    protected function addBotMessage(string $content)
    {
        $this->messages[] = ['sender' => 'bot', 'content' => $content];
    }

    /**
     * Render tampilan komponen Livewire.
     */
    public function render()
    {
        return view('livewire.chat-bot');
    }
}
