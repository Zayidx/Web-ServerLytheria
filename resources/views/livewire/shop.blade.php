<div class="py-24 bg-black/20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-white" data-aos="fade-up">Toko {{ $settings['server_name'] ?? 'Nilai Default' }}</h1>
            <p class="mt-4 text-lg text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">Dukung server dan dapatkan keuntungan eksklusif di dalam game!</p>
        </div>

        <!-- Bagian Diskon -->
        <section id="discounts" class="mb-24">
            <h2 class="text-3xl font-bold text-white mb-8 text-center" data-aos="fade-up">
                <i class="fas fa-fire-alt text-yellow-400 mr-2"></i> Penawaran Terbatas
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Discount Card 1 -->
                <div class="glass-card rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-6 flex items-center gap-6">
                        <img src="https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e" alt="Starter Pack" class="w-24 h-24 object-contain rounded-lg">
                        <div class="flex-1">
                            <span class="text-xs font-bold uppercase bg-red-600 text-white px-2 py-1 rounded-full">DISKON 25%</span>
                            <h4 class="text-xl font-bold text-white mt-2">Paket Pemula</h4>
                            <div class="flex items-baseline gap-2 mt-1">
                                <p class="text-2xl font-bold text-blue-500">Rp 45.000</p>
                                <p class="text-lg text-gray-500 line-through">Rp 60.000</p>
                            </div>
                            <a href="#" class="mt-4 block btn btn-primary w-full py-2 rounded-lg font-semibold text-center">Dapatkan Penawaran</a>
                        </div>
                    </div>
                </div>
                 <!-- Discount Card 2 -->
                <div class="glass-card rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-6 flex items-center gap-6">
                        <img src="https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e" alt="Rank Bundle" class="w-24 h-24 object-contain rounded-lg">
                        <div class="flex-1">
                            <span class="text-xs font-bold uppercase bg-red-600 text-white px-2 py-1 rounded-full">HEMAT 20%</span>
                            <h4 class="text-xl font-bold text-white mt-2">Bundle Rank Knight</h4>
                            <div class="flex items-baseline gap-2 mt-1">
                                <p class="text-2xl font-bold text-blue-500">Rp 40.000</p>
                                <p class="text-lg text-gray-500 line-through">Rp 50.000</p>
                            </div>
                            <a href="#" class="mt-4 block btn btn-primary w-full py-2 rounded-lg font-semibold text-center">Dapatkan Penawaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bagian Ranks -->
        <section id="ranks">
            <h2 class="text-3xl font-bold text-white mb-8 text-center" data-aos="fade-up">Pilihan Rank</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Rank Card: Knight -->
                <div class="glass-card rounded-xl p-8 flex flex-col" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-bold text-white">Knight</h3>
                        <p class="text-4xl font-extrabold text-blue-500 mt-2">Rp 50.000</p>
                        <p class="text-gray-500">Per Bulan</p>
                    </div>
                    <ul class="space-y-3 text-gray-300 flex-grow mb-8">
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Kit Knight setiap 24 jam</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Akses ke /fly di lobi</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Prioritas masuk saat server penuh</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Nama dengan prefix [Knight]</li>
                    </ul>
                    <a href="#" class="btn btn-secondary w-full py-3 rounded-lg font-bold text-center">Pilih Rank</a>
                </div>

                <!-- Rank Card: Paladin (Paling Populer) -->
                <div class="relative rounded-xl p-1 bg-gradient-to-br from-blue-500 to-indigo-600" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-yellow-400 text-black font-bold text-sm px-3 py-1 rounded-full">PALING POPULER</div>
                    <div class="bg-secondary h-full rounded-lg p-8 flex flex-col">
                        <div class="text-center mb-6">
                            <h3 class="text-3xl font-bold text-white">Paladin</h3>
                            <p class="text-4xl font-extrabold text-white mt-2">Rp 100.000</p>
                            <p class="text-white">Per Bulan</p>
                        </div>
                        <ul class="space-y-3 text-gray-300 flex-grow mb-8">
                            <li class="flex items-center"><i class="fas fa-check-circle text-white mr-3"></i> Semua keuntungan rank Knight</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-white mr-3"></i> Kit Paladin setiap 24 jam</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-white mr-3"></i> Akses ke /feed</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-white mr-3"></i> 2x Poin Vote</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-white mr-3"></i> Nama dengan prefix [Paladin]</li>
                        </ul>
                        <a href="#" class="btn btn-primary w-full py-3 rounded-lg font-bold text-center">Pilih Rank</a>
                    </div>
                </div>

                <!-- Rank Card: Emperor -->
                <div class="glass-card rounded-xl p-8 flex flex-col" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-bold text-white">Emperor</h3>
                        <p class="text-4xl font-extrabold text-blue-500 mt-2">Rp 200.000</p>
                        <p class="text-gray-500">Per Bulan</p>
                    </div>
                    <ul class="space-y-3 text-gray-300 flex-grow mb-8">
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Semua keuntungan rank Paladin</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Kit Emperor setiap 24 jam</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Akses ke partikel eksklusif</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> 3x Poin Vote</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i> Nama dengan prefix [Emperor]</li>
                    </ul>
                    <a href="#" class="btn btn-secondary w-full py-3 rounded-lg font-bold text-center">Pilih Rank</a>
                </div>

            </div>
        </section>

        <!-- Bagian Item & Kosmetik -->
        <section id="items" class="mt-24">
            <h2 class="text-3xl font-bold text-white mb-8 text-center" data-aos="fade-up">Item & Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Item Card 1 -->
                <div class="glass-card rounded-xl overflow-hidden text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-black/20 p-6">
                        <img src="https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e" alt="Crate Key" class="w-24 h-24 mx-auto object-contain">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-white">Legendary Crate Key</h4>
                        <p class="text-2xl font-bold text-blue-500 mt-2">Rp 25.000</p>
                        <a href="#" class="mt-4 block btn btn-secondary w-full py-2 rounded-lg font-semibold">Beli</a>
                    </div>
                </div>
                <!-- Item Card 2 -->
                <div class="glass-card rounded-xl overflow-hidden text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-black/20 p-6">
                        <img src="https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e" alt="Uang In-game" class="w-24 h-24 mx-auto object-contain">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-white">1 Juta Uang In-Game</h4>
                        <p class="text-2xl font-bold text-blue-500 mt-2">Rp 15.000</p>
                        <a href="#" class="mt-4 block btn btn-secondary w-full py-2 rounded-lg font-semibold">Beli</a>
                    </div>
                </div>
                <!-- Item Card 3 -->
                <div class="glass-card rounded-xl overflow-hidden text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-black/20 p-6">
                        <img src="https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e" alt="Partikel" class="w-24 h-24 mx-auto object-contain">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-white">Efek Partikel Naga</h4>
                        <p class="text-2xl font-bold text-blue-500 mt-2">Rp 75.000</p>
                        <a href="#" class="mt-4 block btn btn-secondary w-full py-2 rounded-lg font-semibold">Beli</a>
                    </div>
                </div>
                <!-- Item Card 4 -->
                <div class="glass-card rounded-xl overflow-hidden text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-black/20 p-6">
                        <img src="https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e" alt="Claim Land" class="w-24 h-24 mx-auto object-contain">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-white">Ekstra 5 Claim Land</h4>
                        <p class="text-2xl font-bold text-blue-500 mt-2">Rp 30.000</p>
                        <a href="#" class="mt-4 block btn btn-secondary w-full py-2 rounded-lg font-semibold">Beli</a>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
