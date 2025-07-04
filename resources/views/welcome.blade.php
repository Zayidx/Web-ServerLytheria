<x-layouts.app>
    <!-- Hero Section -->
    <section class="relative text-center py-28 md:py-40 lg:py-48 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-bg-primary"></div>
        <div class="absolute inset-0" style="background-image: url('{{ asset('storage/bghome.png') }}'); background-size: cover; background-position: center; filter: blur(5px) saturate(1.2); opacity: 0.3;"></div>
        <div class="relative container mx-auto px-6">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight" data-aos="fade-up">
                Jelajahi Dunia <span class="text-teal-400 text-glow">{{ $settings['server_name'] ?? 'Nilai Default' }}</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Temukan petualangan epik, bangun mahakarya, dan jadilah bagian dari komunitas game terbaik di Indonesia.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row justify-center items-center gap-4" data-aos="fade-up" data-aos-delay="400">
                <a href="#" class="btn btn-primary text-lg font-bold py-3 px-10 rounded-lg w-full sm:w-auto">
                    <i class="fas fa-play mr-2"></i> Gabung Sekarang
                </a>
                <a href="#" class="btn btn-secondary text-lg font-bold py-3 px-10 rounded-lg w-full sm:w-auto">
                    <i class="fab fa-discord mr-2"></i> Join Discord
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container mx-auto px-6 -mt-20 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Stat Card 1: Pemain Online -->
            <div class="relative p-1 rounded-xl bg-gradient-to-br from-teal-400/50 to-bg-primary" data-aos="fade-up">
                <div class="bg-secondary h-full rounded-lg p-6 flex flex-col items-center text-center md:flex-row md:text-left md:items-start gap-5">
                    <div class="bg-teal-900/50 text-teal-300 p-4 rounded-lg">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-4xl font-bold text-white">1,245</h3>
                        <p class="mt-1 text-gray-400">Pemain Online</p>
                    </div>
                </div>
            </div>
            <!-- Stat Card 2: Versi Server -->
            <div class="relative p-1 rounded-xl bg-gradient-to-br from-teal-400/50 to-bg-primary" data-aos="fade-up" data-aos-delay="150">
                <div class="bg-secondary h-full rounded-lg p-6 flex flex-col items-center text-center md:flex-row md:text-left md:items-start gap-5">
                    <div class="bg-teal-900/50 text-teal-300 p-4 rounded-lg">
                        <i class="fas fa-gamepad text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-4xl font-bold text-white">1.21.x</h3>
                        <p class="mt-1 text-gray-400">Java & Bedrock</p>
                    </div>
                </div>
            </div>
            <!-- Stat Card 3: Status Server -->
            <div class="relative p-1 rounded-xl bg-gradient-to-br from-teal-400/50 to-bg-primary" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-secondary h-full rounded-lg p-6 flex flex-col items-center text-center md:flex-row md:text-left md:items-start gap-5">
                    <div class="bg-teal-900/50 text-teal-300 p-4 rounded-lg">
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
                <!-- Gamemode Card 1: Survival RPG -->
                <div class="glass-card group rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-80">
                        <img src="{{ asset('storage/bghome.png') }}" alt="Survival RPG" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-3xl font-bold text-white">Survival RPG</h3>
                            <button @click="openModal = true; selectedGamemode = {
                                title: 'Survival RPG',
                                image: @json(asset('storage/bghome.png')),
                                description: 'Bertahan hidup di dunia yang luas dengan sistem level, skill unik, misi menantang, dan dungeon berbahaya. Kumpulkan sumber daya, buat perlengkapan legendaris, dan jadilah petualang terhebat di {{ $settings['server_name'] ?? 'Nilai Default' }}.'
                            }" class="mt-4 text-teal-300 font-semibold hover:text-white transition">
                                Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Gamemode Card 2: Skyblock Galaxy -->
                <div class="glass-card group rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-80">
                        <img src="{{ asset('storage/bghome.png') }}" alt="Skyblock Galaxy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-3xl font-bold text-white">Skyblock Galaxy</h3>
                            <button @click="openModal = true; selectedGamemode = {
                                title: 'Skyblock Galaxy',
                                image: @json(asset('storage/bghome.png')),
                                description: 'Mulai petualangan dari sebuah pulau kecil di angkasa. Kembangkan pulaumu, bangun generator otomatis, berdagang dengan pemain lain di pusat ekonomi, dan taklukkan tantangan untuk menjadi penguasa langit.'
                            }" class="mt-4 text-teal-300 font-semibold hover:text-white transition">
                                Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Gamemode Card 3: Creative Plots -->
                <div class="glass-card group rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-80">
                        <img src="{{ asset('storage/bghome.png') }}" alt="Creative Plots" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-3xl font-bold text-white">Creative Plots</h3>
                            <button @click="openModal = true; selectedGamemode = {
                                title: 'Creative Plots',
                                image: @json(asset('storage/bghome.png')),
                                description: 'Bebaskan imajinasimu di dunia tanpa batas. Dapatkan lahan pribadimu dan bangun apa pun yang kamu inginkan dengan akses ke semua blok dan item. Pamerkan mahakaryamu kepada seluruh komunitas.'
                            }" class="mt-4 text-teal-300 font-semibold hover:text-white transition">
                                Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
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
                <div class="glass-card rounded-xl p-6 flex flex-col md:flex-row items-center gap-6" data-aos="fade-right">
                    <img src="{{ asset('storage/bghome.png') }}" alt="Pembaruan Server" class="w-full md:w-1/3 h-auto object-cover rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm text-teal-400 mb-2 font-semibold">30 Juni 2024</p>
                        <h3 class="text-2xl font-bold text-white mb-3">Pembaruan Besar: The Nether Rises!</h3>
                        <p class="text-gray-400">Jelajahi bioma Nether baru, hadapi musuh baru, dan temukan item legendaris. Update ini juga membawa perbaikan performa server secara signifikan.</p>
                    </div>
                </div>
                <div class="glass-card rounded-xl p-6 flex flex-col md:flex-row items-center gap-6" data-aos="fade-left">
                    <img src="{{ asset('storage/bghome.png') }}" alt="Event Komunitas" class="w-full md:w-1/3 h-auto object-cover rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm text-teal-400 mb-2 font-semibold">25 Juni 2024</p>
                        <h3 class="text-2xl font-bold text-white mb-3">Event Komunitas: Lomba Membangun</h3>
                        <p class="text-gray-400">Tunjukkan kreativitasmu dalam lomba membangun bertema 'Kerajaan Bawah Air'. Pemenang akan mendapatkan hadiah rank eksklusif dan item langka!</p>
                    </div>
                </div>
            </div>
            <!-- Tombol Lihat Semua Berita -->
            <div class="text-center mt-16" data-aos="fade-up">
                <a href="#" class="btn btn-secondary text-lg font-bold py-3 px-10 rounded-lg">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Combined Action Section -->
    <section id="actions" class="py-24">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white" data-aos="fade-up">Tingkatkan Pengalamanmu</h2>
                <p class="mt-4 text-lg text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Dukung server, bersaing di papan peringkat, dan dapatkan item eksklusif untuk menjadikan petualanganmu lebih seru.
                </p>
            </div>

            <!-- 3-Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1: Vote -->
                <div class="glass-card p-8 text-center rounded-xl flex flex-col items-center hover:transform hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-teal-900/50 text-teal-300 p-5 rounded-full mb-6">
                        <i class="fas fa-vote-yea text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Dukung Server</h3>
                    <p class="text-gray-400 mb-6 flex-grow">Vote untuk membantu server berkembang dan dapatkan hadiah eksklusif di dalam game.</p>
                    <a href="#" target="_blank" class="btn btn-secondary w-full py-3 font-bold rounded-lg mt-auto">
                        Voting Sekarang
                    </a>
                </div>

                <!-- Card 2: Leaderboard -->
                <div class="glass-card p-8 text-center rounded-xl flex flex-col items-center hover:transform hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-teal-900/50 text-teal-300 p-5 rounded-full mb-6">
                        <i class="fas fa-trophy text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Papan Peringkat</h3>
                    <p class="text-gray-400 mb-6 flex-grow">Lihat siapa yang mendominasi server dan bersaing untuk menjadi yang terbaik.</p>
                    <a href="#" target="_blank" class="btn btn-secondary w-full py-3 font-bold rounded-lg mt-auto">
                        Lihat Peringkat
                    </a>
                </div>

                <!-- Card 3: Store -->
                <div class="glass-card p-8 text-center rounded-xl flex flex-col items-center hover:transform hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-teal-900/50 text-teal-300 p-5 rounded-full mb-6">
                        <i class="fas fa-shopping-cart text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Toko Server</h3>
                    <p class="text-gray-400 mb-6 flex-grow">Dapatkan rank, kosmetik, dan item unik untuk meningkatkan pengalaman bermainmu.</p>
                    <a href="#" target="_blank" class="btn btn-primary w-full py-3 font-bold rounded-lg mt-auto">
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
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">Tanya {{ $settings['server_name'] ?? 'Nilai Default' }}Bot AI</h2>
                <p class="text-gray-400 mb-10" data-aos="fade-up" data-aos-delay="100">Asisten AI kami siap menjawab pertanyaanmu seputar server 24/7.</p>
            </div>
            
            <!-- Panggil Komponen Livewire Chatbot -->
            @livewire('chat-bot')
            
        </div>
    </section>

    
</x-layouts.app>
