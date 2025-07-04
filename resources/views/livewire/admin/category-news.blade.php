<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6"> <!-- Adjusted for stacking on small screens -->
            <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0 text-center sm:text-left w-full sm:w-auto">Manajemen Kategori Berita</h1>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-5 w-full sm:w-auto"> <!-- Adjusted for stacking buttons -->
                <button wire:click="create()" class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                </button>
                <button class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto">
                    <a href="{{ route('admin.news') }}"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </button>
            </div>
        </div>

        @if($isFormModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" x-data="{ open: @entangle('isFormModalOpen') }" x-show="open" @keydown.escape.window="open = false" style="display: none;">
            <div class="glass-card rounded-xl shadow-lg w-full max-w-full md:max-w-lg max-h-[90vh] flex flex-col overflow-hidden" @click.away="open = false"> <!-- Adjusted max-w for mobile, added flex-col and overflow-hidden -->
                <form wire:submit.prevent="store" class="flex flex-col flex-1"> <!-- Added flex-col and flex-1 -->
                    <div class="p-6">
                        <div class="flex justify-between items-center pb-4 border-b border-border-color">
                            <h3 class="text-xl md:text-2xl font-bold text-white">{{ $categoryId ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h3> <!-- Responsive text size -->
                            <button type="button" wire:click="closeModal()" class="text-gray-400 hover:text-white text-3xl leading-none">&times;</button>
                        </div>
                    </div>
                    <div class="p-6 flex-1 overflow-y-auto"> <!-- Added flex-1 and overflow-y-auto -->
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-text-secondary">Nama Kategori</label>
                                <input type="text" id="name" wire:model.lazy="name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-text-secondary">Deskripsi (Opsional)</label>
                                <textarea id="description" wire:model.lazy="description" rows="3" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"></textarea> <!-- Added px-3 py-2 -->
                                @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-bg-secondary/50 border-t border-border-color text-right rounded-b-xl flex justify-end gap-2"> <!-- Added flex and gap for buttons -->
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary px-4 py-2 rounded-lg">Batal</button>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-bg-primary divide-y divide-border-color">
                        @forelse ($categories as $category)
                        <tr class="hover:bg-gray-800/40 transition">
                            <td class="px-6 py-4 text-sm font-medium text-white">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ \Illuminate\Support\Str::limit($category->description, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $category->id }})" class="text-teal-400 hover:text-teal-300">Edit</button>
                                <button wire:click="$dispatch('swal:confirm', { id: {{ $category->id }}, method: 'destroyCategory' })" class="ml-4 text-red-500 hover:text-red-400">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-400">Tidak ada data kategori ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
