<div class="py-24 bg-black/20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-white" data-aos="fade-up">Toko {{ $settings['server_name'] ?? 'Nilai Default' }}</h1>
            <p class="mt-4 text-lg text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">Dukung server dan dapatkan keuntungan eksklusif di dalam game!</p>
        </div>

        @if($discounts->isNotEmpty())
        <section id="discounts" class="mb-24">
            <h2 class="text-3xl font-bold text-white mb-8 text-center" data-aos="fade-up">
                <i class="fas fa-fire-alt text-yellow-400 mr-2"></i> Penawaran Terbatas
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @foreach($discounts as $item)
                <div class="glass-card rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="p-6 flex items-center gap-6">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-24 h-24 object-contain rounded-lg">
                        <div class="flex-1">
                            @if($item->original_price)
                            <span class="text-xs font-bold uppercase bg-red-600 text-white px-2 py-1 rounded-full">DISKON {{ round((($item->original_price - $item->price) / $item->original_price) * 100) }}%</span>
                            @endif
                            <h4 class="text-xl font-bold text-white mt-2">{{ $item->name }}</h4>
                            <div class="flex items-baseline gap-2 mt-1">
                                <p class="text-2xl font-bold text-blue-500">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                @if($item->original_price)
                                <p class="text-lg text-gray-500 line-through">Rp {{ number_format($item->original_price, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            <a href="#" class="mt-4 block btn btn-primary w-full py-2 rounded-lg font-semibold text-center">Dapatkan Penawaran</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if($ranks->isNotEmpty())
        <section id="ranks">
            <h2 class="text-3xl font-bold text-white mb-8 text-center" data-aos="fade-up">Pilihan Rank</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($ranks as $rank)
                    @php
                        $features = json_decode($rank->description);
                    @endphp
                    <div class="{{ $rank->is_popular ? 'relative rounded-xl p-1 bg-gradient-to-br from-blue-500 to-indigo-600' : 'glass-card rounded-xl' }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        @if($rank->is_popular)
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-yellow-400 text-black font-bold text-sm px-3 py-1 rounded-full">PALING POPULER</div>
                        <div class="bg-secondary h-full rounded-lg p-8 flex flex-col">
                        @else
                        <div class="p-8 flex flex-col h-full">
                        @endif
                            <div class="text-center mb-6">
                                <h3 class="text-3xl font-bold text-white">{{ $rank->name }}</h3>
                                <p class="text-4xl font-extrabold {{ $rank->is_popular ? 'text-white' : 'text-blue-500' }} mt-2">Rp {{ number_format($rank->price, 0, ',', '.') }}</p>
                                <p class="{{ $rank->is_popular ? 'text-white' : 'text-gray-500' }}">Per Bulan</p>
                            </div>
                            <ul class="space-y-3 text-gray-300 flex-grow mb-8">
                                @if(is_array($features))
                                    @foreach($features as $feature)
                                    <li class="flex items-center"><i class="fas fa-check-circle {{ $rank->is_popular ? 'text-white' : 'text-blue-500' }} mr-3"></i> {{ $feature }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <a href="#" class="btn {{ $rank->is_popular ? 'btn-primary' : 'btn-secondary' }} w-full py-3 rounded-lg font-bold text-center mt-auto">Pilih Rank</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        @if($otherItems->isNotEmpty())
        <section id="items" class="mt-24">
            <h2 class="text-3xl font-bold text-white mb-8 text-center" data-aos="fade-up">Item & Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($otherItems as $item)
                <div class="glass-card rounded-xl overflow-hidden text-center" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="bg-black/20 p-6">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-24 h-24 mx-auto object-contain">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-white">{{ $item->name }}</h4>
                        <p class="text-2xl font-bold text-blue-500 mt-2">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <a href="#" class="mt-4 block btn btn-secondary w-full py-2 rounded-lg font-semibold">Beli</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
