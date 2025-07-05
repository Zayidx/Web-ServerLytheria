<div class="">
    <!-- Hero Section -->
    <section class="relative text-center py-28 md:py-40 lg:py-48 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-bg-primary"></div>
        <div class="absolute inset-0" style="background-image: url('{{ $settings['hero_background_image_url'] ?? 'Nilai Default' }}'); background-size: cover; background-position: center; filter: blur(5px) saturate(1.2); opacity: 0.3;"></div>
        <div class="relative container mx-auto px-6">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight" data-aos="fade-up">
                Jelajahi Dunia <span class="text-blue-400 text-glow">{{ $settings['server_name'] ?? 'Lytheria SMP' }}</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                {{ $settings['server_description'] ?? 'Temukan petualangan epik, bangun mahakarya, dan jadilah bagian dari komunitas game terbaik di Indonesia.' }}
            </p>
            <div class="mt-10 flex flex-col sm:flex-row justify-center items-center gap-4" data-aos="fade-up" data-aos-delay="400">
                <button @click.prevent="copyToClipboard('{{ $settings['server_ip'] ?? 'play.lytheriamc.net' }}')" class="btn btn-primary text-lg font-bold py-3 px-10 rounded-lg w-full sm:w-auto">
                    <i class="fas fa-play mr-2"></i> Gabung Sekarang
                </button>
                <a href="{{ $settings['discord_link'] ?? '#' }}" target="_blank" class="btn btn-secondary text-lg font-bold py-3 px-10 rounded-lg w-full sm:w-auto">
                    <i class="fab fa-discord mr-2"></i> Join Discord
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container mx-auto px-6 -mt-20 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Stat Card 1: Pemain Online -->
            <div class="relative p-1 rounded-xl bg-gradient-to-br from-blue-500/50 to-bg-primary" data-aos="fade-up">
                <div class="bg-secondary h-full rounded-lg p-6 flex flex-col items-center text-center md:flex-row md:text-left md:items-start gap-5">
                    <div class="bg-blue-500/10 text-blue-400 p-4 rounded-lg">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-4xl font-bold text-white">1,245</h3>
                        <p class="mt-1 text-gray-400">Pemain Online</p>
                    </div>
                </div>
            </div>
            <!-- Stat Card 2: Versi Server -->
            <div class="relative p-1 rounded-xl bg-gradient-to-br from-blue-500/50 to-bg-primary" data-aos="fade-up" data-aos-delay="150">
                <div class="bg-secondary h-full rounded-lg p-6 flex flex-col items-center text-center md:flex-row md:text-left md:items-start gap-5">
                    <div class="bg-blue-500/10 text-blue-400 p-4 rounded-lg">
                        <i class="fas fa-gamepad text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-4xl font-bold text-white">{{ $settings['minecraft_version'] ?? '1.21.x' }}</h3>
                        <p class="mt-1 text-gray-400">Java & Bedrock</p>
                    </div>
                </div>
            </div>
            <!-- Stat Card 3: Status Server -->
            <div class="relative p-1 rounded-xl bg-gradient-to-br from-blue-500/50 to-bg-primary" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-secondary h-full rounded-lg p-6 flex flex-col items-center text-center md:flex-row md:text-left md:items-start gap-5">
                    <div class="bg-blue-500/10 text-blue-400 p-4 rounded-lg">
                        <i class="fas fa-server text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-4xl font-bold text-green-400">Online</h3>
                        <p class="mt-1 text-gray-400">Status Server</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Game Modes Section -->
    <section id="gamemodes" class="py-24" x-data="{ openModal: false, selectedGamemode: {} }">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold text-center text-white mb-16" data-aos="fade-up">Mode Permainan Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($gamemodes as $index => $gamemode)
                <div class="glass-card group rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="relative h-80">
                        <img src="{{ $gamemode->image_url }}" alt="{{ $gamemode->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-3xl font-bold text-white">{{ $gamemode->name }}</h3>
                            <button @click="openModal = true; selectedGamemode = {
                                title: '{{ addslashes($gamemode->name) }}',
                                image: '{{ $gamemode->image_url }}',
                                description: '{{ addslashes($gamemode->description) }}'
                            }" class="mt-4 text-blue-400 font-semibold hover:text-white transition">
                                Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-400 col-span-3">Gamemodes will be listed here soon.</p>
                @endforelse
            </div>
        </div>

        <!-- Modal -->
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
             style="display: none;">
            <div @click.away="openModal = false" class="glass-card rounded-xl max-w-2xl w-full mx-auto overflow-hidden">
                <div class="relative">
                    <img :src="selectedGamemode.image" alt="" class="w-full h-64 object-cover">
                    <button @click="openModal = false" class="absolute top-4 right-4 text-white bg-black/50 rounded-full w-8 h-8 flex items-center justify-center hover:bg-black/75 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6">
                    <h3 class="text-3xl font-bold text-white" x-text="selectedGamemode.title"></h3>
                    <p class="mt-4 text-gray-300" x-text="selectedGamemode.description"></p>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="py-24 bg-black/20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold text-center text-white mb-16" data-aos="fade-up">Berita & Pembaruan</h2>
            <div class="space-y-8">
                @forelse($news as $item)
                <div class="glass-card rounded-xl p-6 flex flex-col md:flex-row items-center gap-6" data-aos="fade-right">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full md:w-1/3 h-auto object-cover rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm text-blue-400 mb-2 font-semibold">{{ $item->published_at->format('d F Y') }}</p>
                        <h3 class="text-2xl font-bold text-white mb-3">{{ $item->title }}</h3>
                        <p class="text-gray-400">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                        <a href="{{ route('news.detail', $item->slug) }}" class="mt-4 inline-block text-blue-400 font-semibold hover:text-white transition">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-400" data-aos="fade-up">
                    <p>Belum ada berita untuk saat ini.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-16" data-aos="fade-up">
                <a href="{{ route('news') }}" class="btn btn-secondary text-lg font-bold py-3 px-10 rounded-lg">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Combined Action Section -->
    <section id="actions" class="py-24">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white" data-aos="fade-up">Tingkatkan Pengalamanmu</h2>
                <p class="mt-4 text-lg text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Dukung server, bersaing di papan peringkat, dan dapatkan item eksklusif untuk menjadikan petualanganmu lebih seru.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1: Vote -->
                <div class="glass-card p-8 text-center rounded-xl flex flex-col items-center hover:transform hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-blue-500/10 text-blue-400 p-5 rounded-full mb-6">
                        <i class="fas fa-vote-yea text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Dukung Server</h3>
                    <p class="text-gray-400 mb-6 flex-grow">Vote untuk membantu server berkembang dan dapatkan hadiah eksklusif di dalam game.</p>
                    <a href="{{ route('vote') }}" class="btn btn-secondary w-full py-3 font-bold rounded-lg mt-auto">
                        Voting Sekarang
                    </a>
                </div>
                <!-- Card 2: Leaderboard -->
                <div class="glass-card p-8 text-center rounded-xl flex flex-col items-center hover:transform hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-blue-500/10 text-blue-400 p-5 rounded-full mb-6">
                        <i class="fas fa-trophy text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Papan Peringkat</h3>
                    <p class="text-gray-400 mb-6 flex-grow">Lihat siapa yang mendominasi server dan bersaing untuk menjadi yang terbaik.</p>
                    <a href="#" class="btn btn-secondary w-full py-3 font-bold rounded-lg mt-auto">
                        Lihat Peringkat
                    </a>
                </div>
                <!-- Card 3: Store -->
                <div class="glass-card p-8 text-center rounded-xl flex flex-col items-center hover:transform hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-blue-500/10 text-blue-400 p-5 rounded-full mb-6">
                        <i class="fas fa-shopping-cart text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Toko Server</h3>
                    <p class="text-gray-400 mb-6 flex-grow">Dapatkan rank, kosmetik, dan item unik untuk meningkatkan pengalaman bermainmu.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary w-full py-3 font-bold rounded-lg mt-auto">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- AI Chatbot Section -->
    <section id="chatbot" class="py-24 bg-black/20">
        <div class="container mx-auto px-6 max-w-3xl">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">Tanya {{ $settings['server_name'] ?? 'Lytheria' }}Bot AI</h2>
                <p class="text-gray-400 mb-10" data-aos="fade-up" data-aos-delay="100">Asisten AI kami siap menjawab pertanyaanmu seputar server 24/7.</p>
            </div>
            
            @livewire('chat-bot')
            
        </div>
    </section>
</div>
