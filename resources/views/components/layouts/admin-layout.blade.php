<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ $settings['server_name'] ?? 'Nilai Default' }}</title>
    <link rel="icon" type="image/png" href="{{$settings['logo_url']}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }
        .btn { transition: all 0.3s ease; }
        .btn-primary { background-image: linear-gradient(45deg, var(--accent-primary), var(--accent-dark)); color: #FFFFFF; font-weight: 600; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 15px -5px var(--accent-primary); }
        .btn-secondary { background-color: transparent; border: 1px solid var(--border-color); color: var(--text-primary); }
        .btn-secondary:hover { background-color: var(--bg-secondary); border-color: var(--accent-primary); color: var(--accent-primary); }
        .glass-card { background: rgba(22, 27, 34, 0.6); backdrop-filter: blur(10px); border: 1px solid var(--border-color); }
        .nav-active { background-color: var(--bg-primary); color: var(--accent-primary); font-weight: 600; }
        .text-accent { color: var(--accent-primary); }

        .editor-toolbar, .EasyMDEContainer .cm-s-easymde { background-color: #161B22; border-color: #30363d; color: #c9d1d9; }
        .editor-toolbar a { color: #8b949e !important; border: none !important; }
        .editor-toolbar a.active, .editor-toolbar a:hover { background: #30363d; color: #c9d1d9 !important; }
        .CodeMirror { border-color: #30363d !important; background-color: #0D1117 !important; }
        .editor-preview, .editor-preview-side { background-color: #0D1117 !important; }
        .cm-s-easymde .CodeMirror-cursor { border-left: 1px solid #c9d1d9 !important; }

        /* Custom CSS for Responsive Navigation */
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 50;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            background-color: var(--bg-secondary);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }

        .overlay.active {
            display: block;
        }

        .menu-button {
            display: block;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.75rem;
            border-radius: 0.5rem;
            cursor: pointer;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 60;
        }

        .main-content-wrapper {
            transition: margin-left 0.3s ease-in-out;
        }

        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
                position: relative;
                box-shadow: none;
                width: 16rem;
            }
            .menu-button {
                display: none;
            }
            .overlay {
                display: none;
            }
            .main-content-wrapper {
                margin-left: 0;
            }
        }

        @media (max-width: 767px) {
            .sidebar.active .sidebar-header {
                padding-left: 5rem;
            }
        }
    </style>
    @livewireStyles
    @stack('styles')
</head>
<body class="antialiased">
    <div class="flex h-screen bg-bg-primary">
        <div id="sidebar-overlay" class="overlay" onclick="toggleSidebar()"></div>

        <button class="menu-button md:hidden" onclick="toggleSidebar()">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <aside id="sidebar" class="w-64 flex-shrink-0 bg-secondary border-r border-gray-800 flex flex-col sidebar">
            <div class="px-6 py-4 border-b border-gray-800 sidebar-header">
                <a href="/" class="text-2xl font-bold text-white flex items-center gap-3">
                    <img class="w-10 h-10" src="{{ $settings['logo_url'] ?? 'Nilai Default' }}" alt="">
                    <span>{{ $settings['server_name'] ?? 'Nilai Default' }}</span>
                </a>
                <span class="text-xs text-blue-400 ml-1">Admin Panel</span>
            </div>
            <nav class="mt-6 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-tachometer-alt fa-fw w-6 text-center"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.news') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.news') ? 'nav-active' : '' }}">
                    <i class="fas fa-newspaper fa-fw w-6 text-center"></i><span>Manajemen Berita</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.categories') ? 'nav-active' : '' }}">
                    <i class="fas fa-tags fa-fw w-6 text-center"></i><span>Kategori Berita</span>
                </a>
                <a href="{{ route('admin.gamemodes') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.categories') ? 'nav-active' : '' }}">
        <i class="fas fa-gamepad fa-fw w-6 text-center"></i>
        Gamemodes
    </a>
                <a href="{{ route('admin.owners') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.owners') ? 'nav-active' : '' }}">
                    <i class="fas fa-user-shield fa-fw w-6 text-center"></i><span>Manajemen Owner</span>
                </a>
                <a href="{{ route('admin.votes') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.vote') ? 'nav-active' : '' }}">
                    <i class="fas fa-vote-yea fa-fw w-6 text-center"></i><span>Manajemen Vote</span>
                </a>
                <a href="{{ route('admin.shop') }}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white transition {{ request()->routeIs('admin.shop') ? 'nav-active' : '' }}">
                    <i class="fas fa-vote-yea fa-fw w-6 text-center"></i><span>Manajemen Toko</span>
                </a>
            </nav>
            <div class="px-6 py-4 border-t border-gray-800">
                <a href="/" target="_blank" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-400 hover:bg-gray-800/50 hover:text-white transition rounded-md">
                    <i class="fas fa-arrow-left fa-fw w-5 text-center"></i>
                    <span>Kembali ke Situs</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-400 hover:bg-red-900/50 hover:text-red-300 transition rounded-md">
                        <i class="fas fa-sign-out-alt fa-fw w-5 text-center"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-6 md:p-10 main-content-wrapper">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:success', event => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: event.message,
                    icon: 'success',
                    background: '#161B22',
                    color: '#c9d1d9',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: 'var(--accent-primary)'
                });
            });

            Livewire.on('swal:confirm', event => {
                Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#30363d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    background: '#161B22',
                    color: '#c9d1d9',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(event.method, { id: event.id });
                    }
                })
            });
        });
    </script>
</body>
</html>
