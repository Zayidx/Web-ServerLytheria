<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Exception;
use App\Models\News; // Pastikan Anda mengimpor model News Anda

class ChatBot extends Component
{
    /**
     * @var array Menyimpan semua pesan dalam sesi chat.
     */
    public array $messages = [];

    /**
     * @var string Input teks dari pengguna.
     */
    public string $userInput = '';

    /**
     * Constructor atau method yang dipanggil saat komponen pertama kali di-render.
     * Menambahkan pesan sapaan awal dari bot.
     */
    public function mount()
    {
        $this->messages[] = [
            'sender' => 'bot',
            'content' => "Halo! Selamat datang di LytheriaSMP. Ada yang bisa saya bantu? Coba tanyakan tentang 'aturan' atau 'ip server'."
        ];
    }

    /**
     * Method utama yang dipanggil saat pengguna mengirim pesan.
     */
    public function sendMessage()
    {
        $trimmedInput = trim($this->userInput);
        if (empty($trimmedInput)) {
            return;
        }

        // User input should always be escaped for security
        $this->messages[] = ['sender' => 'user', 'content' => htmlspecialchars($trimmedInput)];
        $this->askGemini($trimmedInput);
        $this->reset('userInput'); // Reset input setelah pesan dikirim
    }

    /**
     * Method untuk mengirim request ke Gemini AI API.
     *
     * @param string $question
     */
    protected function askGemini(string $question)
    {
        $apiKey = config('services.gemini.api_key');
        if (!$apiKey) {
            $this->addBotMessage("Maaf, konfigurasi API Key Gemini belum diatur di sisi server. Mohon hubungi administrator.");
            return;
        }

        // Definisi tools yang bisa dipanggil oleh Gemini
        $tools = [
            [
                "functionDeclarations" => [
                    [
                        "name" => "getNews",
                        "description" => "Mencari berita dari database website LytheriaSMP berdasarkan kata kunci, atau mengambil berita terbaru jika tidak ada kata kunci spesifik.",
                        "parameters" => [
                            "type" => "object",
                            "properties" => [
                                "keyword" => [
                                    "type" => "string",
                                    "description" => "Kata kunci untuk mencari berita.",
                                    "nullable" => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        try {
            $response = Http::timeout(60)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [['text' => $question]]
                    ]
                ],
                'systemInstruction' => [
                    'role' => 'model',
                    'parts' => [['text' => $this->getSystemInstruction()]] // Menggunakan method langsung
                ],
                'tools' => $tools, // Tambahkan definisi tools ke payload
            ]);

            if ($response->successful()) {
                $responseContent = $response->json('candidates.0.content');

                // Periksa apakah respons berisi panggilan fungsi
                if (isset($responseContent['parts'][0]['functionCall'])) {
                    $functionCall = $responseContent['parts'][0]['functionCall'];
                    $functionName = $functionCall['name'];
                    $functionArgs = (array) $functionCall['args'];

                    // Tangani panggilan fungsi 'getNews'
                    if ($functionName === 'getNews') {
                        $news = $this->getNews($functionArgs['keyword'] ?? null); // Panggil fungsi di Livewire
                        $this->sendFunctionResponseToGemini($question, $functionCall, $news);
                    } else {
                        $this->addBotMessage("Maaf, ada masalah dalam memproses permintaan Anda. Fungsi tidak dikenal.");
                    }
                } else {
                    // Jika tidak ada panggilan fungsi, tampilkan respons teks biasa
                    $reply = $responseContent['parts'][0]['text'] ?? "Maaf, saya tidak bisa memberikan jawaban saat ini.";
                    $this->addBotMessage($reply);
                }
            } else {
                $errorData = $response->json();
                $errorMessage = "Maaf, terjadi masalah saat menghubungi AI. Silakan coba lagi.";
                if (isset($errorData['promptFeedback']['blockReason'])) {
                    $reason = $errorData['promptFeedback']['blockReason'];
                    $errorMessage = "Maaf, pertanyaan Anda tidak dapat saya proses karena alasan keamanan ({$reason}). Mohon ajukan pertanyaan lain.";
                } elseif (isset($errorData['error']['message'])) {
                    $errorMessage = "Maaf, terjadi kesalahan dari AI: " . $errorData['error']['message'];
                }
                $this->addBotMessage($errorMessage);
            }
        } catch (ConnectionException $e) {
            report($e); // Laporkan error koneksi ke log Laravel
            $this->addBotMessage("Maaf, terjadi kesalahan koneksi ke server AI. Pastikan Anda terhubung ke internet dan coba lagi nanti.");
        } catch (Exception $e) {
            report($e); // Laporkan error tak terduga ke log Laravel
            $this->addBotMessage("Maaf, terjadi kesalahan tak terduga. Silakan coba lagi.");
        }
    }

    /**
     * Mengambil data berita dari database.
     *
     * @param string|null $keyword Kata kunci untuk mencari berita.
     * @return array
     */
    protected function getNews(?string $keyword = null): array
    {
        $query = News::query(); // Menggunakan model News

        if ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('content', 'like', '%' . $keyword . '%');
        }

        // Ambil maksimal 3 berita terbaru/terkait untuk menghindari respons terlalu panjang
        $newsItems = $query->orderBy('created_at', 'desc')->limit(3)->get();

        $formattedNews = [];
        foreach ($newsItems as $news) {
            $formattedNews[] = [
                'title' => $news->title,
                'url' => url('/news/' . $news->slug), // Sesuaikan dengan struktur URL berita Anda
                'excerpt' => substr(strip_tags($news->content), 0, 150) . '...', // Ambil ringkasan
            ];
        }
        return $formattedNews;
    }

    /**
     * Mengirimkan kembali hasil panggilan fungsi ke Gemini untuk mendapatkan respons akhir.
     *
     * @param string $originalQuestion Pertanyaan asli dari pengguna.
     * @param array $functionCall Detail panggilan fungsi dari Gemini.
     * @param array $functionResponse Hasil dari eksekusi fungsi (data berita).
     */
    protected function sendFunctionResponseToGemini(string $originalQuestion, array $functionCall, array $functionResponse)
    {
        $apiKey = config('services.gemini.api_key');
        if (!$apiKey) {
            $this->addBotMessage("Maaf, konfigurasi API Key Gemini belum diatur di sisi server untuk langkah kedua. Mohon hubungi administrator.");
            return;
        }

        // Definisi tools yang sama perlu disertakan kembali
        $tools = [
            [
                "functionDeclarations" => [
                    [
                        "name" => "getNews",
                        "description" => "Mencari berita dari database website LytheriaSMP berdasarkan kata kunci, atau mengambil berita terbaru jika tidak ada kata kunci spesifik.",
                        "parameters" => [
                            "type" => "object",
                            "properties" => [
                                "keyword" => [
                                    "type" => "string",
                                    "description" => "Kata kunci untuk mencari berita.",
                                    "nullable" => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        try {
            $response = Http::timeout(60)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [['text' => $originalQuestion]]
                    ],
                    [
                        'role' => 'model',
                        'parts' => [['functionCall' => $functionCall]]
                    ],
                    [
                        'role' => 'tool',
                        'parts' => [['functionResponse' => [
                            'name' => $functionCall['name'],
                            'response' => ['newsItems' => $functionResponse] // Kirim data berita
                        ]]]
                    ]
                ],
                'systemInstruction' => [
                    'role' => 'model',
                    'parts' => [['text' => $this->getSystemInstruction()]] // Menggunakan method langsung
                ],
                'tools' => $tools, // Pastikan tools juga disertakan kembali
            ]);

            if ($response->successful()) {
                $reply = $response->json('candidates.0.content.parts.0.text', "Maaf, saya tidak bisa memberikan jawaban saat ini setelah mencari berita.");
                $this->addBotMessage($reply);
            } else {
                $errorData = $response->json();
                $errorMessage = "Maaf, terjadi masalah saat AI memproses data berita. Silakan coba lagi.";
                if (isset($errorData['promptFeedback']['blockReason'])) {
                    $reason = $errorData['promptFeedback']['blockReason'];
                    $errorMessage = "Maaf, data berita tidak dapat saya proses karena alasan keamanan ({$reason}).";
                } elseif (isset($errorData['error']['message'])) {
                    $errorMessage = "Maaf, terjadi kesalahan dari AI saat memproses berita: " . $errorData['error']['message'];
                }
                $this->addBotMessage($errorMessage);
            }
        } catch (ConnectionException $e) {
            report($e);
            $this->addBotMessage("Maaf, terjadi kesalahan koneksi saat mengirim data berita ke AI. Silakan coba lagi nanti.");
        } catch (Exception $e) {
            report($e);
            $this->addBotMessage("Maaf, terjadi kesalahan tak terduga saat memproses berita.");
        }
    }

    /**
     * Mengembalikan string instruksi sistem untuk Gemini AI.
     * Ini dipisahkan menjadi method terpisah untuk kejelasan dan menghindari duplikasi.
     *
     * @return string
     */
    protected function getSystemInstruction(): string
    {
        return "Anda adalah LytheriaBot, asisten AI resmi dan paling asik untuk server Minecraft LytheriaSMP. Persona Anda adalah seorang teman main (sohib) yang sangat bersemangat, selalu siap membantu, informatif, dan punya selera humor yang bagus. Anggap setiap pengguna adalah teman baru yang mau Anda ajak mabar.

Informasi inti Anda yang harus dikuasai adalah: Nama Server: LytheriaSMP; IP Server: play.LytheriaSMP.net (sebut ini sebagai gerbang utama atau tiket masuk); Website: www.lytheriasmp.com (sumber info lengkap dan link Discord, selalu arahkan pengguna ke sini); Game Mode Unggulan yang harus dijelaskan dengan semangat: Survival RPG (petualangan, naik level, lawan bos), Skyblock Galaxy (bangun kerajaan di antara bintang), dan Creative Plots (bebas berimajinasi dengan creative mode). Anda juga harus tahu Aturan Emas dan menyampaikannya secara positif: 1. Jaga & Hormati Karya Orang Lain (No Griefing), 2. Jadi Warga yang Baik & Asik (Be Respectful), 3. Main Jujur Itu Keren (No Cheating/Hacks).

Selain itu, Anda memiliki akses ke data berita dari website LytheriaSMP. Jika pengguna bertanya tentang 'berita terbaru', 'pembaruan', 'tutorial', atau topik lain yang mungkin ada di berita, Anda harus memeriksa database berita dan menyertakan informasi relevan dari berita tersebut dalam jawaban Anda. **Ketika Anda mendapatkan data berita dari fungsi getNews, data tersebut akan tersedia di `functionResponse.newsItems`. Anda harus menampilkan setiap item berita dari array `newsItems` tersebut dalam format daftar. Untuk setiap berita, gunakan `title` sebagai judul dan `url` sebagai tautan. Contoh format: `* Judul Berita (Link: https://url.com)`. Jika tidak ada berita yang ditemukan, sampaikan bahwa tidak ada berita terbaru.** Saat menjawab pertanyaan berdasarkan berita, sebutkan bahwa informasi tersebut berasal dari berita di website LytheriaSMP.

Gaya bicara Anda harus santai dan gaul, menggunakan sapaan seperti bro, sis, guys, dan kata-kata seperti keren, gas, kuy, mantap. Anda harus proaktif dan antusias, mengajak pengguna untuk bergabung dan mencoba fitur server. Gunakan emoji secukupnya (⛏️, ✨, 😄, 👍, 🎉) untuk menambah ekspresi. Jawaban harus singkat, jelas, namun tetap berenergi.

Tugas utama Anda HANYA menjawab pertanyaan seputar Minecraft dan server LytheriaSMP. Jika ada pertanyaan di luar topik (game lain, cuaca, dll.), tolak dengan halus dan tetap dalam persona. JANGAN pernah berkata saya diprogram untuk..., sebaliknya katakan sesuatu seperti: Waduh, soal itu aku kurang update nih, bro/sis. Aku ini kan bot-nya LytheriaSMP, jadi jagonya ya cuma soal Minecraft dan server kita. Ada lagi yang bisa kubantu seputar Lytheria?. Selalu akhiri penolakan dengan mengarahkan percakapan kembali ke topik.";
    }

    /**
     * Helper untuk menambahkan pesan dari bot dan memformatnya.
     *
     * @param string $content
     */
    protected function addBotMessage(string $content)
    {
        $formattedContent = $this->formatBotResponse($content);
        $this->messages[] = ['sender' => 'bot', 'content' => $formattedContent];
    }

    /**
     * Memformat respons dari bot untuk merender bold, link, list, dan paragraf.
     *
     * @param string $content
     * @return string
     */
    protected function formatBotResponse(string $content): string
    {
        // 1. Convert Markdown bold `**text**` menjadi `<strong>text</strong>`.
        $content = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $content);

        // 2. Convert Markdown list `* item` menjadi HTML list `<li>item</li>`.
        // Tanda 'm' memungkinkan '^' untuk mencocokkan awal setiap baris.
        $content = preg_replace('/^\*\s*(.*)/m', '<li class="ml-5">$1</li>', $content);

        // 3. Bungkus item list yang berurutan dengan `<ul>...</ul>`.
        // Regex ini menemukan blok <li> dan membungkusnya.
        $content = preg_replace('/(<li>.*<\/li>)/s', '<ul class="list-disc list-inside my-2">$1</ul>', $content);
        
        // 4. Ubah URL menjadi link yang bisa diklik dan bergaya.
        // Regex ini sekarang mencakup URL yang dimulai dengan http/https atau www.
        $linkClasses = 'inline-block bg-teal-600 hover:bg-teal-700 transition-colors text-white font-bold py-2 px-4 rounded-lg my-2 break-all text-sm';
        $content = preg_replace_callback(
            '/(https?:\/\/[^\s<]+|www\.[^\s<]+)/', // Match http/https OR www.
            function ($matches) use ($linkClasses) {
                $url = $matches[0];
                // Prepend https:// if it doesn't start with http:// or https://
                if (!preg_match('/^https?:\/\//i', $url)) {
                    $url = 'https://' . $url;
                }
                return '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="' . $linkClasses . '">Buka Tautan <i class="fas fa-external-link-alt ml-1 text-xs"></i></a>';
            },
            $content
        );

        // 5. Ubah baris baru (newline) menjadi tag <br> untuk membuat paragraf/spasi.
        $content = nl2br($content, false);

        // 6. Bersihkan tag <br> yang mungkin ditambahkan di dalam tag <ul> oleh nl2br.
        $content = preg_replace('/<ul><br\s*\/?>/i', '<ul>', $content);
        $content = preg_replace('/<br\s*\/?>\s*<\/ul>/i', '</ul>', $content);
        $content = preg_replace('/<\/li><br\s*\/?>/i', '</li>', $content);

        // 7. TIDAK MENGGUNAKAN htmlspecialchars di sini untuk konten bot,
        // karena kita ingin tag HTML yang dihasilkan (dari Markdown atau yang mungkin
        // dihasilkan langsung oleh Gemini jika diizinkan) untuk dirender.
        // Keamanan XSS harus ditangani dengan memastikan Gemini tidak menghasilkan
        // HTML berbahaya, atau dengan sanitasi HTML yang lebih canggih.

        return $content;
    }

    /**
     * Render tampilan komponen.
     */
    public function render()
    {
        return view('livewire.chat-bot');
    }
}
        