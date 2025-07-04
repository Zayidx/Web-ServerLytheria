<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6"> <!-- Adjusted for stacking on small screens -->
            <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0 text-center sm:text-left w-full sm:w-auto">Manajemen Berita</h1>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-5 w-full sm:w-auto"> <!-- Adjusted for stacking buttons -->
                <button wire:click="create()" class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>Tambah Berita
                </button>
                <button class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto">
                    <a href="{{ route('admin.categories') }}"><i class="fas fa-plus mr-2"></i>Tambah Kategori</a>
                </button>
            </div>
        </div>

        @if($isFormModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" x-data="{ open: @entangle('isFormModalOpen') }" x-show="open" @keydown.escape.window="open = false" style="display: none;">
            <div class="glass-card rounded-xl shadow-lg w-full max-w-full md:max-w-4xl max-h-[90vh] flex flex-col overflow-y-scroll" @click.away="open = false"> <!-- Adjusted max-w for mobile -->
                <form wire:submit.prevent="store" class="flex flex-col flex-1">
                    <div class="p-6">
                        <div class="flex justify-between items-center pb-4 border-b border-border-color">
                            <h3 class="text-xl md:text-2xl font-bold text-white">{{ $newsId ? 'Edit Berita' : 'Tambah Berita Baru' }}</h3> <!-- Responsive text size -->
                            <button type="button" wire:click="$set('isFormModalOpen', false)" class="text-gray-400 hover:text-white text-3xl leading-none">&times;</button>
                        </div>
                    </div>
                    <div class="p-6 flex-1 overflow-y-auto">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2 space-y-6">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-text-secondary">Judul Berita</label>
                                    <input type="text" id="title" wire:model.lazy="title" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div wire:ignore>
                                    <label for="content" class="block text-sm font-medium text-text-secondary">Konten (Markdown)</label>
                                    <textarea id="content" class="hidden"></textarea>
                                </div>
                                @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-text-secondary">Status</label>
                                    <select id="status" wire:model.lazy="status" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="categoryId" class="block text-sm font-medium text-text-secondary">Kategori</label>
                                    <select id="categoryId" wire:model.lazy="categoryId" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="ownerId" class="block text-sm font-medium text-text-secondary">Penulis</label>
                                    <select id="ownerId" wire:model.lazy="ownerId" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                        <option value="">Pilih Penulis</option>
                                        @foreach($owners as $owner)
                                            <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('ownerId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="imageUrl" class="block text-sm font-medium text-text-secondary">URL Gambar Header</label>
                                    <input type="url" id="imageUrl" wire:model.lazy="imageUrl" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                    @error('imageUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="imageCaption" class="block text-sm font-medium text-text-secondary">Keterangan Gambar</label>
                                    <input type="text" id="imageCaption" wire:model.lazy="imageCaption" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                    @error('imageCaption') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-bg-secondary/50 border-t border-border-color text-right rounded-b-xl flex justify-end gap-2"> <!-- Added flex and gap for buttons -->
                        <button type="button" wire:click="$set('isFormModalOpen', false)" class="btn btn-secondary px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <div class="glass-card rounded-xl mt-6 overflow-hidden">
            <div class="overflow-x-auto"> <!-- Added for horizontal scrolling on small screens -->
                <table class="min-w-full divide-y divide-border-color">
                    <thead class="bg-bg-secondary">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Penulis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-bg-primary divide-y divide-border-color">
                        @forelse($news as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ \Illuminate\Support\Str::limit($item->title, 40) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 'published' ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">{{ $item->owner->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $item->id }})" class="text-teal-400 hover:text-teal-300">Edit</button>
                                <button wire:click="$dispatch('swal:confirm', { id: {{ $item->id }}, method: 'destroy' })" class="ml-4 text-red-500 hover:text-red-400">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-text-secondary">Belum ada berita yang ditambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            let easyMDE = null;

            // Fungsi untuk menginisialisasi atau menghancurkan editor
            const setupEditor = (content) => {
                // Hancurkan instance lama jika ada
                if (easyMDE) {
                    easyMDE.toTextArea();
                    easyMDE = null;
                }

                // Inisialisasi instance baru
                const textarea = document.getElementById('content');
                if (textarea) {
                    easyMDE = new EasyMDE({
                        element: textarea,
                        initialValue: content,
                        spellChecker: false,
                        minHeight: '250px',
                        maxHeight: '400px',
                        // Anda bisa menambahkan atau mengurangi toolbar di sini
                        toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "side-by-side", "fullscreen"],
                    });

                    // Update properti Livewire saat konten editor berubah
                    easyMDE.codemirror.on('change', () => {
                        @this.set('content', easyMDE.value());
                    });
                }
            };

            // Listener untuk event dari backend
            Livewire.on('initialize-editor', (event) => {
                // Beri sedikit jeda agar DOM modal sepenuhnya siap
                setTimeout(() => {
                    setupEditor(event.content);
                }, 50); 
            });
        });
    </script>
    @endpush
</div>
