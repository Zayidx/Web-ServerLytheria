<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lytheria SMP - Dunia Petualangan Baru' }}</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
            color: #FFFFFF; /* Diubah agar kontras dengan background biru */
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
            word-wrap: break-word; /* Menambahkan ini untuk menangani teks panjang */
        }
        .chat-bubble.user {
            background-image: linear-gradient(45deg, var(--accent-primary), var(--accent-dark));
            color: #FFFFFF; /* Diubah agar kontras */
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
        
        /* Mengganti warna hover pada Navigasi & Tautan lainnya */
        .hover-text-accent:hover {
            color: var(--accent-secondary);
        }

        .prose-custom {
                color: #d1d5db; /* text-gray-300 */
                font-size: 1.125rem; /* text-lg */
                line-height: 1.75;
                overflow-wrap: break-word;
                word-wrap: break-word;
                word-break: break-word;
            }

            /* Headings */
            .prose-custom h1, .prose-custom h2, .prose-custom h3, .prose-custom h4, .prose-custom strong {
                color: #ffffff;
                font-weight: 700;
                word-break: break-word;
            }
            .prose-custom h1 { font-size: 2.25rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent-primary); }
            .prose-custom h2 { font-size: 1.875rem; margin-top: 2.5rem; margin-bottom: 1.25rem; border-bottom: 1px solid #30363d; padding-bottom: 0.5rem; }
            .prose-custom h3 { font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; }

            /* Paragraphs & Links */
            .prose-custom p { margin-bottom: 1.25em; }
            .prose-custom a {
                color: var(--accent-primary);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s ease-in-out;
                word-break: break-all;
            }
            .prose-custom a:hover { color: var(--accent-secondary); text-decoration: underline; }
            
            /* Blockquotes */
            .prose-custom blockquote {
                margin: 1.5em 0;
                padding-left: 1.5em;
                border-left: 4px solid var(--accent-primary);
                font-style: italic;
                color: #c9d1d9;
            }
            .prose-custom blockquote p {
                margin: 0;
            }

            /* Lists */
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
                content: '\25A0'; /* Square bullet */
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

            /* Images */
            .prose-custom img {
                width: 100%;
                border-radius: 0.75rem;
                margin: 2em 0;
                border: 1px solid #30363d;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }
            
            /* Code blocks */
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
<body class="antialiased">

   {{ $slot }}

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @livewireScripts
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Script for mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
