<div class="py-24 bg-black/20">
    <div class="container mx-auto px-6">
        <article class="max-w-4xl mx-auto">
            <header class="text-center mb-12">
                <p class="text-sm text-blue-400 mb-2 font-semibold">{{ $news->category->name }}</p>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight break-words">
                    {{ $news->title }}
                </h1>
                <div class="mt-4 flex justify-center items-center text-gray-400">
                    <span>Dipublikasikan pada <time datetime="{{ $news->published_at->toIso8601String() }}">{{ $news->published_at->format('d F Y') }}</time> oleh</span>
                    <img class="h-8 w-8 rounded-full object-cover ml-3 mr-2" src="{{ $news->owner->profile_image_url ?: 'https://placehold.co/40x40/161B22/c9d1d9?text=' . substr($news->owner->name, 0, 1) }}" alt="{{ $news->owner->name }}">
                    <span class="text-blue-300">{{ $news->owner->name }}</span>
                </div>
            </header>

            @if($news->image_url)
            <figure class="mb-12">
                <img src="{{ $news->image_url }}" alt="{{ $news->image_caption ?? $news->title }}" class="w-full h-auto object-cover rounded-xl shadow-lg">
                @if($news->image_caption)
                    <figcaption class="text-center text-sm text-gray-500 mt-2">{{ $news->image_caption }}</figcaption>
                @endif
            </figure>
            @endif

            <div class="prose-custom">
                {!! \Illuminate\Support\Str::markdown($news->content) !!}
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('news') }}" class="btn btn-secondary text-lg font-bold py-3 px-10 rounded-lg">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                </a>
            </div>
        </article>
    </div>
</div>

@push('styles')
<style>
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
    .prose-custom blockquote p {
        margin: 0;
    }

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
@endpush
