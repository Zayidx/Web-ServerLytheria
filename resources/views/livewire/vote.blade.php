<div class="py-24">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white" data-aos="fade-up">Dukung {{ $settings['server_name'] ?? 'Nilai Default' }}!</h1>
        <p class="mt-4 text-lg text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">Setiap vote sangat berarti bagi kami. Dengan melakukan vote, Anda tidak hanya membantu server menjadi lebih dikenal, tetapi juga mendapatkan hadiah eksklusif di dalam game sebagai tanda terima kasih kami.</p>

        <!-- Daftar Situs Voting Dinamis -->
        <div class="mt-16 max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            
            @forelse($votes as $vote)
                <div class="glass-card rounded-xl p-6 text-left flex flex-col" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 + 200 }}">
                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-white">{{ $vote->name }}</h3>
                        <p class="text-gray-400 mt-2">{{ $vote->description }}</p>
                        <p class="mt-4 text-blue-400 font-semibold"><i class="fas fa-gift mr-2"></i> Hadiah: {{ $vote->hadiah }}</p>
                    </div>
                    <a href="{{ $vote->url }}" target="_blank" class="mt-6 block btn btn-primary text-center py-3 rounded-lg font-bold">
                        Vote di {{ $vote->name }}
                    </a>
                </div>
            @empty
                <div class="md:col-span-2 text-center py-10">
                    <p class="text-gray-400">Saat ini belum ada link vote yang tersedia. Silakan cek kembali nanti.</p>
                </div>
            @endforelse

        </div>
    </div>
</div>
