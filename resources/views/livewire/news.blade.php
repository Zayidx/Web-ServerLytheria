<div class="py-24 bg-black/20">
    <div class="container mx-auto px-6">
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white">Berita & Pengumuman</h1>
            <p class="mt-2 text-lg text-gray-400">Ikuti perkembangan terbaru dari dunia {{ $settings['server_name'] ?? 'Nilai Default' }}.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($news as $item)
                <div class="glass-card rounded-xl overflow-hidden flex flex-col group" wire:key="{{ $item->id }}">
                    <a href="{{ route('news.detail', $item->slug) }}">
                        <img src="{{ $item->image_url ?: 'https://placehold.co/600x400/161B22/c9d1d9?text=Berita' }}" alt="{{ $item->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-sm text-blue-400 font-semibold">{{ $item->category->name }}</p>
                        <h2 class="mt-2 text-xl font-bold text-white flex-1 truncate">
                            <a href="{{ route('news.detail', $item->slug) }}" class="hover:text-blue-300 transition" title="{{ $item->title }}">{{ $item->title }}</a>
                        </h2>
                        <p class="mt-3 text-gray-400 text-sm">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                        </p>
                        <footer class="mt-4 pt-4 border-t border-gray-800 flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                oleh {{ $item->owner->name }} <br>
                                {{ $item->published_at->format('d F Y') }}
                            </div>
                            <a href="{{ route('news.detail', $item->slug) }}" class="text-sm font-semibold text-blue-400 hover:text-white">
                                Baca &rarr;
                            </a>
                        </footer>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-3 text-center py-16">
                    <p class="text-gray-400">Belum ada berita yang dipublikasikan saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $news->links() }}
        </div>
    </div>
</div>
