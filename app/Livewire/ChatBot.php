<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Exception;
use Illuminate\Support\Facades\Log;
// Import model-model yang diperlukan
use App\Models\News;
use App\Models\Vote;
use App\Models\Owner; // Asumsikan ada model Owner jika ini tabelnya
use App\Models\ShopItem; // Asumsikan ada model ShopItem
use App\Models\Gamemode; // Asumsikan ada model Gamemode

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
                'content' => "Halo! Selamat datang di Lytheria. Ada yang bisa saya bantu? Coba tanyakan tentang 'aturan', 'ip server', 'berita terbaru', atau 'item toko'."
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
     * Mengambil data dari database berdasarkan konteks pertanyaan pengguna.
     *
     * @param string $question Pertanyaan terakhir dari pengguna.
     * @return string Data yang relevan dalam format teks.
     */
    protected function getDatabaseContext(string $question): string
    {
        $context = [];
        $questionLower = strtolower($question);

        // Cek untuk berita terbaru
        if (str_contains($questionLower, 'berita') || str_contains($questionLower, 'update')) {
            try {
                $latestNews = News::orderBy('created_at', 'desc')->first();
                if ($latestNews) {
                    $context[] = "Berita Terbaru: " . $latestNews->title . " - " . $latestNews->content;
                } else {
                    $context[] = "Tidak ada berita terbaru yang ditemukan.";
                }
            } catch (Exception $e) {
                Log::error('Gagal mengambil berita: ' . $e->getMessage());
                $context[] = "Maaf, tidak dapat mengambil informasi berita saat ini.";
            }
        }

        // Cek untuk info vote
        if (str_contains($questionLower, 'vote') || str_contains($questionLower, 'cara vote')) {
            try {
                // Asumsi tabel votes memiliki kolom 'link' atau sejenisnya
                $voteInfo = Vote::orderBy('id', 'desc')->first(); // Ambil info vote terbaru atau umum
                if ($voteInfo) {
                    $context[] = "Info Vote: Anda bisa vote melalui link ini: " . ($voteInfo->link ?? 'Tidak ada link spesifik') . ". Vote membantu server dan Anda bisa mendapatkan reward!";
                } else {
                    $context[] = "Tidak ada informasi vote spesifik saat ini, silakan cek website Lytheria untuk link vote.";
                }
            } catch (Exception $e) {
                Log::error('Gagal mengambil info vote: ' . $e->getMessage());
                $context[] = "Maaf, tidak dapat mengambil informasi vote saat ini.";
            }
        }

        // Cek untuk info owner (jika ada tabel khusus owner)
        if (str_contains($questionLower, 'owner') || str_contains($questionLower, 'pemilik server')) {
            try {
                $ownerInfo = Owner::first(); // Asumsi hanya ada satu owner atau kita ambil yang pertama
                if ($ownerInfo) {
                    $context[] = "Pemilik Server Lytheria: " . ($ownerInfo->name ?? 'Tidak diketahui') . ".";
                } else {
                    $context[] = "Informasi pemilik server tidak ditemukan dalam database.";
                }
            } catch (Exception $e) {
                Log::error('Gagal mengambil info owner: ' . $e->getMessage());
                $context[] = "Maaf, tidak dapat mengambil informasi pemilik server saat ini.";
            }
        }

        // Cek untuk item toko
        if (str_contains($questionLower, 'toko') || str_contains($questionLower, 'item') || str_contains($questionLower, 'beli')) {
            try {
                $shopItems = ShopItem::limit(5)->get(); // Ambil beberapa item toko teratas
                if ($shopItems->isNotEmpty()) {
                    $itemsList = $shopItems->map(function($item) {
                        return $item->name . " (Harga: " . ($item->price ?? 'N/A') . ")";
                    })->implode(', ');
                    $context[] = "Beberapa Item di Toko: " . $itemsList . ". Kunjungi toko di server untuk melihat semua item.";
                } else {
                    $context[] = "Tidak ada item toko yang ditemukan saat ini.";
                }
            } catch (Exception $e) {
                Log::error('Gagal mengambil item toko: ' . $e->getMessage());
                $context[] = "Maaf, tidak dapat mengambil informasi item toko saat ini.";
            }
        }

        // Cek untuk mode game
        if (str_contains($questionLower, 'mode game') || str_contains($questionLower, 'gamemode')) {
            try {
                $gamemodes = Gamemode::all(); // Ambil semua gamemode
                if ($gamemodes->isNotEmpty()) {
                    $modesList = $gamemodes->pluck('name')->implode(', ');
                    $context[] = "Mode Game yang Tersedia: " . $modesList . ".";
                } else {
                    $context[] = "Tidak ada mode game spesifik yang ditemukan dalam database, tetapi server ini memiliki Survival RPG, Skyblock Galaxy, dan Creative Plots.";
                }
            } catch (Exception $e) {
                Log::error('Gagal mengambil gamemode: ' . $e->getMessage());
                $context[] = "Maaf, tidak dapat mengambil informasi mode game saat ini.";
            }
        }

        return !empty($context) ? "Data Tambahan dari Database: " . implode(" | ", $context) : "";
    }

    /**
     * Mengirim permintaan ke Google Gemini API dengan riwayat percakapan dan konteks database.
     *
     * @param string $latestQuestion Pertanyaan terakhir dari pengguna.
     */
    protected function askGemini(string $latestQuestion)
    {
        $apiKey = config('services.gemini.api_key');

        if (!$apiKey) {
            $this->addBotMessage("Kesalahan Konfigurasi: Kunci API untuk layanan AI belum diatur di server. Silakan hubungi administrator.");
            Log::error('GEMINI_API_KEY tidak ditemukan di file .env atau config/services.php');
            return;
        }

        // Ambil data kontekstual dari database
        $databaseContext = $this->getDatabaseContext($latestQuestion);

        // Instruksi sistem yang diperbarui untuk AI
        $systemInstruction = "Anda adalah LytheriaBot, asisten AI yang ramah, informatif, dan selalu siap membantu untuk server Minecraft \"Lytheria\". Anda beroperasi 24 jam sehari untuk melayani pertanyaan pemain.
        
        Informasi penting tentang server:
        - Nama Server: Lytheria
        - IP Server: lytheria.online
        - Mode Game yang Tersedia: Survival RPG, Skyblock Galaxy, dan Creative Plots.
        - Aturan Utama: 1. Dilarang merusak (griefing). 2. Bersikap sopan. 3. Dilarang curang (cheat).
        - Discord: Pengguna bisa bergabung melalui tautan di website.

        Tugas Anda:
        1. Jawab pertanyaan pengguna HANYA jika berhubungan dengan Minecraft atau server Lytheria.
        2. Jika pertanyaan di luar topik (misalnya tentang cuaca, politik, atau game lain), tolak dengan sopan. Gunakan frasa seperti: \"Maaf, saya adalah LytheriaBot, asisten AI untuk server Minecraft Lytheria. Saya hanya diprogram untuk menjawab pertanyaan seputar Minecraft dan server Lytheria.\" atau \"Sebagai LytheriaBot, fokus saya hanya pada informasi seputar Minecraft dan server Lytheria.\"
        3. Berikan jawaban yang singkat, jelas, dan ramah.
        4. Anda memiliki akses ke data internal server seperti **berita terbaru, informasi vote, item toko, pemilik server, dan daftar mode game** dari database. Gunakan informasi ini jika relevan dengan pertanyaan pengguna. Jika data tidak ditemukan di database, nyatakan bahwa Anda tidak memiliki informasi spesifik tersebut atau berikan informasi umum yang Anda miliki.
        ";

        // Format riwayat pesan sesuai dengan yang dibutuhkan Gemini API
        $formattedMessages = [];
        foreach ($this->messages as $message) {
            $role = ($message['sender'] === 'bot') ? 'model' : 'user';
            
            if ($role === 'model' && str_contains($message['content'], 'Kesalahan Konfigurasi')) {
                continue;
            }

            $formattedMessages[] = [
                'role' => $role,
                'parts' => [['text' => $message['content']]]
            ];
        }

        // Tambahkan konteks database ke dalam pesan terakhir pengguna yang dikirim ke Gemini
        // Ini memastikan Gemini memiliki data terbaru untuk dipertimbangkan saat merespons pertanyaan yang relevan
        $lastUserMessageIndex = count($formattedMessages) - 1;
        if ($lastUserMessageIndex >= 0 && $formattedMessages[$lastUserMessageIndex]['role'] === 'user') {
            $formattedMessages[$lastUserMessageIndex]['parts'][0]['text'] .= "\n\n" . $databaseContext;
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
                $reply = data_get($response->json(), 'candidates.0.content.parts.0.text', "Maaf, saya tidak dapat memberikan jawaban saat ini. Coba lagi nanti.");
                $this->addBotMessage($reply);
            } else {
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
            Log::error('Koneksi ke Gemini API gagal: ' . $e->getMessage());
            $this->addBotMessage("Maaf, terjadi kesalahan koneksi ke server AI. Pastikan koneksi internet Anda stabil dan coba lagi nanti.");
        } catch (Exception $e) {
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