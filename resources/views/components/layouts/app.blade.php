<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($settings['server_name'] ?? 'Lytheria SMP') }} - Dunia Petualangan Baru</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Menambahkan SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SCRIPT ALPINE.JS MANUAL TELAH DIHAPUS DARI SINI --}}
    {{-- Livewire v3 akan memuatnya secara otomatis untuk menghindari konflik --}}

    <style>
        :root {
            --bg-primary: #0D1117;
            --bg-secondary: #161B22;
            --border-color: #30363d;
            --text-primary: #c9d1d9;
            --text-secondary: #8b949e;
            /* Palet Warna Biru Modern & Futuristik */
            --accent-primary: #3b82f6; /* blue-500 */
            --accent-secondary: #60a5fa; /* blue-400 */
            --accent-dark: #2563eb;   /* blue-600 */
        }

        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            background-image: radial-gradient(circle at 1px 1px, var(--border-color) 1px, transparent 0);
            background-size: 2rem 2rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-secondary); }
        ::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #484f58; }

        .text-glow {
            text-shadow: 0 0 8px var(--accent-primary), 0 0 20px var(--accent-primary);
        }

        .btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-image: linear-gradient(45deg, var(--accent-primary), var(--accent-dark));
            color: #FFFFFF;
            font-weight: 600;
        }
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 20px -10px var(--accent-primary);
        }
        .btn-secondary {
            background-color: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-primary);
        }
        .btn-secondary:hover {
            background-color: var(--bg-secondary);
            border-color: var(--accent-secondary);
            color: var(--accent-secondary);
        }

        .glass-card {
            background: rgba(22, 27, 34, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-primary);
        }

        /* Chatbot Styles from Livewire Component */
        .chat-window {
            height: 400px;
            overflow-y: auto;
            scroll-behavior: smooth;
        }
        .chat-bubble {
            max-width: 75%;
            padding: 12px 16px;
            border-radius: 15px;
            line-height: 1.5;
            word-wrap: break-word;
        }
        .chat-bubble.user {
            background-image: linear-gradient(45deg, var(--accent-primary), var(--accent-dark));
            color: #FFFFFF;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
        }
        .chat-bubble.bot {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            align-self: flex-start;
            border-bottom-left-radius: 5px;
        }

        /* Style for active navigation link */
        .nav-active {
            color: var(--accent-primary);
            font-weight: 600;
        }
        
        .hover-text-accent:hover {
            color: var(--accent-secondary);
        }

        .prose-custom {
            color: #d1d5db;
            font-size: 1.125rem;
            line-height: 1.75;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }
        .prose-custom h1, .prose-custom h2, .prose-custom h3, .prose-custom h4, .prose-custom strong {
            color: #ffffff;
            font-weight: 700;
            word-break: break-word;
        }
        .prose-custom h1 { font-size: 2.25rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent-primary); }
        .prose-custom h2 { font-size: 1.875rem; margin-top: 2.5rem; margin-bottom: 1.25rem; border-bottom: 1px solid #30363d; padding-bottom: 0.5rem; }
        .prose-custom h3 { font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; }
        .prose-custom p { margin-bottom: 1.25em; }
        .prose-custom a {
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease-in-out;
            word-break: break-all;
        }
        .prose-custom a:hover { color: var(--accent-secondary); text-decoration: underline; }
        .prose-custom blockquote {
            margin: 1.5em 0;
            padding-left: 1.5em;
            border-left: 4px solid var(--accent-primary);
            font-style: italic;
            color: #c9d1d9;
        }
        .prose-custom blockquote p { margin: 0; }
        .prose-custom ul, .prose-custom ol {
            margin: 1.25em 0;
            padding-left: 0;
        }
        .prose-custom li {
            position: relative;
            padding-left: 1.75em;
            margin-bottom: 0.5em;
        }
        .prose-custom ul { list-style: none; }
        .prose-custom ul li::before {
            content: '\25A0';
            color: var(--accent-primary);
            font-weight: bold;
            display: inline-block;
            position: absolute;
            left: 0;
            top: 0.1em;
        }
        .prose-custom ol { list-style: none; counter-reset: list-counter; }
        .prose-custom ol li { counter-increment: list-counter; }
        .prose-custom ol li::before {
            content: counter(list-counter) ".";
            color: var(--accent-primary);
            font-weight: 700;
            display: inline-block;
            position: absolute;
            left: 0;
            top: 0;
        }
        .prose-custom img {
            width: 100%;
            border-radius: 0.75rem;
            margin: 2em 0;
            border: 1px solid #30363d;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .prose-custom code::before, .prose-custom code::after { content: none !important; }
        .prose-custom code { 
            background-color: #161B22; 
            padding: 0.2em 0.4em; 
            border-radius: 6px; 
            font-size: 0.85em;
            font-weight: 600;
            color: var(--accent-secondary);
            word-break: break-all;
        }
        .prose-custom pre {
            background-color: #010409;
            border: 1px solid #30363d;
            padding: 1rem;
            border-radius: 0.5rem;
            white-space: pre-wrap;
        }
        .prose-custom pre code {
            background-color: transparent;
            padding: 0;
            border-radius: 0;
            font-weight: normal;
            color: inherit;
            white-space: pre-wrap;
        }
    </style>
    @livewireStyles
</head>
<body class="antialiased"
      x-data="{
          copyToClipboard(text) {
              if (!navigator.clipboard) {
                  Swal.fire({
                      title: 'Gagal',
                      text: 'Fitur clipboard tidak didukung di browser Anda.',
                      icon: 'error',
                      background: '#161B22',
                      color: '#c9d1d9',
                      confirmButtonColor: 'var(--accent-primary)'
                  });
                  return;
              }
              navigator.clipboard.writeText(text).then(() => {
                  Swal.fire({
                      title: 'Berhasil!',
                      html: `IP Server telah disalin:<br><code class='bg-gray-800 text-blue-300 px-2 py-1 rounded mt-2 inline-block'>${text}:25565</code>`,
                      icon: 'success',
                      timer: 2500,
                      timerProgressBar: true,
                      showConfirmButton: false,
                      background: '#161B22',
                      color: '#c9d1d9',
                  });
              }, () => {
                  Swal.fire({
                      title: 'Gagal',
                      text: 'Tidak dapat menyalin IP. Coba lagi secara manual.',
                      icon: 'error',
                      background: '#161B22',
                      color: '#c9d1d9',
                      confirmButtonColor: 'var(--accent-primary)'
                  });
              });
          }
      }">

    <header class="bg-black/60 backdrop-blur-lg sticky top-0 z-50 border-b border-gray-800">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-white flex items-center gap-3">
                <img class="w-10 h-10" src="{{ $settings['server_logo'] ?? asset('storage/logo.png') }}" alt="Logo Server">
                <span>{{ $settings['server_name'] ?? 'Lytheria SMP' }}</span>
            </a>
            <div class="hidden md:flex items-center space-x-8 font-medium">
                <a href="/" class="{{ request()->is('/') ? 'nav-active' : 'text-gray-300' }} hover-text-accent transition">Tentang</a>
                <a href="{{ route('news') }}" class="{{ request()->is('news*') ? 'nav-active' : 'text-gray-300' }} hover-text-accent transition">Berita</a>
                <a href="{{ route('vote') }}" class="{{ request()->is('vote') ? 'nav-active' : 'text-gray-300' }} hover-text-accent transition">Vote</a>
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button class="text-gray-300 hover-text-accent transition font-medium flex items-center">
                        Informasi <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute -left-4 mt-2 w-48 bg-black/80 backdrop-blur-md border border-gray-800 rounded-lg shadow-lg py-2 z-50"
                         style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700/50 hover-text-accent transition">Peta Dunia (Map)</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700/50 hover-text-accent transition">Status Server</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700/50 hover-text-accent transition">Wiki</a>
                    </div>
                </div>
                <a href="{{ route('shop') }}" class="{{ request()->is('shop') ? 'nav-active' : 'text-gray-300' }} hover-text-accent transition">Toko</a>
                <a href="/#chatbot" class="hover-text-accent transition">AI Chat</a>
            </div>
            <button @click.prevent="copyToClipboard('{{ $settings['server_ip'] ?? 'play.lytheriamc.net' }}')" class="hidden md:block btn btn-primary py-2 px-6 rounded-lg">
                Mulai Bermain
            </button>
             <button id="mobile-menu-button" class="md:hidden text-white text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
            <a href="/" class="block py-2 {{ request()->is('/') ? 'nav-active' : 'text-gray-300' }} hover-text-accent">Tentang</a>
            <a href="{{ route('news') }}" class="block py-2 {{ request()->is('news*') ? 'nav-active' : 'text-gray-300' }} hover-text-accent">Berita</a>
            <a href="{{ route('vote') }}" class="block py-2 {{ request()->is('vote') ? 'nav-active' : 'text-gray-300' }} hover-text-accent">Vote</a>
            <a href="#" class="block py-2 text-gray-300 hover-text-accent">Peta Dunia</a>
            <a href="#" class="block py-2 text-gray-300 hover-text-accent">Status Server</a>
            <a href="#" class="block py-2 text-gray-300 hover-text-accent">Wiki</a>
            <a href="{{ route('shop') }}" class="block py-2 text-gray-300 hover-text-accent">Toko</a>
            <a href="/#chatbot" class="block py-2 text-gray-300 hover-text-accent">AI Chat</a>
            <button @click.prevent="copyToClipboard('{{ $settings['server_ip'] ?? 'play.lytheriamc.net' }}')" class="mt-4 block btn btn-primary py-2 px-5 rounded-lg text-center w-full">
                Mulai Bermain
            </button>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-black/40 border-t border-gray-800">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold text-white mb-4">{{ $settings['server_name'] ?? 'Lytheria SMP' }}</h3>
                    <p class="text-gray-400 max-w-md">{{ $settings['server_description'] ?? 'Server Minecraft Indonesia yang berfokus pada fitur unik dan pengalaman bermain yang ramah untuk semua pemain.' }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover-text-accent transition">Forum</a></li>
                        <li><a href="#" class="text-gray-400 hover-text-accent transition">Wiki</a></li>
                        <li><a href="#" class="text-gray-400 hover-text-accent transition">Status Server</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover-text-accent transition">Admin Login</a></li>
                    </ul>
                </div>
                <div>
                     <h3 class="text-lg font-semibold text-white mb-4">Komunitas</h3>
                    <div class="flex items-center gap-4 mt-4">
                        <a href="{{ $settings['discord_link'] ?? '#' }}" target="_blank" class="text-gray-400 hover-text-accent transition text-2xl"><i class="fab fa-discord"></i></a>
                        <a href="{{ $settings['youtube_link'] ?? '#' }}" target="_blank" class="text-gray-400 hover-text-accent transition text-2xl"><i class="fab fa-youtube"></i></a>
                        <a href="{{ $settings['instagram_link'] ?? '#' }}" target="_blank" class="text-gray-400 hover-text-accent transition text-2xl"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-gray-800 pt-6 text-center text-gray-500 text-sm">
                <p>{{ $settings['footer_copyright'] ?? '© ' . date('Y') . ' Lytheria SMP. All rights reserved.' }}</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Skrip yang aman untuk menu mobile
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

    @livewireScripts
</body>
</html>
