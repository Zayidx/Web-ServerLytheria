<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0 text-center sm:text-left w-full sm:w-auto">Manajemen Toko</h1>
            <button wire:click="create()" class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto flex items-center justify-center gap-2">
                <i class="fas fa-plus mr-2"></i>Tambah Item
            </button>
        </div>

        @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" x-data="{ open: @entangle('isModalOpen') }" x-show="open" @keydown.escape.window="open = false" style="display: none;">
            <div class="glass-card rounded-xl shadow-lg w-full max-w-full md:max-w-2xl max-h-[90vh] flex flex-col overflow-hidden" @click.away="open = false">
                <form wire:submit.prevent="store" class="flex-1 flex flex-col">
                    <div class="p-6">
                        <div class="flex justify-between items-center pb-4 border-b border-border-color">
                            <h3 class="text-xl md:text-2xl font-bold text-white">{{ $itemId ? 'Edit Item' : 'Tambah Item Baru' }}</h3>
                            <button type="button" wire:click="closeModal()" class="text-gray-400 hover:text-white text-3xl leading-none">&times;</button>
                        </div>
                    </div>
                    <div class="p-6 flex-1 overflow-y-auto space-y-4">
                        <div>
                            <label for="category" class="block text-sm text-gray-300">Kategori</label>
                            <select wire:model.live="category" id="category" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                <option value="item">Item</option>
                                <option value="rank">Rank</option>
                                <option value="discount">Diskon</option>
                            </select>
                        </div>
                        <div>
                            <label for="name" class="block text-sm text-gray-300">Nama</label>
                            <input type="text" wire:model.defer="name" id="name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        @if($category === 'rank')
                            <div>
                                <label class="block text-sm text-gray-300">Fitur-fitur</label>
                                <div class="space-y-2 mt-1">
                                    @foreach($features as $index => $feature)
                                    <div class="flex items-center gap-2">
                                        <input type="text" wire:model.defer="features.{{ $index }}.value" class="block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                                        <button type="button" wire:click="removeFeature({{ $index }})" class="text-red-500 hover:text-red-400 p-1">&times;</button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" wire:click="addFeature" class="mt-2 text-sm text-accent-secondary hover:text-accent-primary">+ Tambah Fitur</button>
                            </div>
                        @else
                            <div>
                                <label for="description" class="block text-sm text-gray-300">Deskripsi</label>
                                <textarea wire:model.defer="description" id="description" rows="3" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"></textarea>
                            </div>
                        @endif

                        <div>
                            <label for="price" class="block text-sm text-gray-300">Harga (Rp)</label>
                            <input type="number" step="1000" wire:model.defer="price" id="price" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($category === 'discount')
                        <div>
                            <label for="original_price" class="block text-sm text-gray-300">Harga Asli (Rp) - <span class="italic">Opsional</span></label>
                            <input type="number" step="1000" wire:model.defer="original_price" id="original_price" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('original_price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        @if($category !== 'rank')
                        <div>
                            <label for="image_url" class="block text-sm text-gray-300">URL Gambar</label>
                            <input type="url" wire:model.defer="image_url" id="image_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" wire:model.defer="is_popular" id="is_popular" class="h-4 w-4 bg-gray-800 border-gray-700 rounded text-accent-primary focus:ring-accent-primary">
                                <label for="is_popular" class="ml-2 block text-sm text-gray-300">Tandai Populer</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="status" class="text-sm text-gray-300">Status</label>
                                <select wire:model.defer="status" id="status" class="bg-gray-800 border-gray-700 rounded-md text-white text-sm py-1 px-2 focus:ring-accent-primary focus:border-accent-primary">
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-bg-secondary/50 border-t border-border-color text-right rounded-b-xl flex justify-end gap-2">
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <div class="glass-card rounded-xl mt-6 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border-color">
                    <thead class="bg-bg-secondary">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-bg-primary divide-y divide-border-color">
                        @forelse ($shopItems as $item)
                        <tr class="hover:bg-gray-800/40 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-accent-primary/20 text-accent-secondary">
                                    {{ ucfirst($item->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                                @if($item->original_price)
                                    <span class="line-through">Rp {{ number_format($item->original_price, 0, ',', '.') }}</span><br>
                                @endif
                                <span class="font-semibold text-white">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 'active' ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $item->id }})" class="text-teal-400 hover:text-teal-300">Edit</button>
                                <button wire:click="$dispatch('swal:confirm', { id: {{ $item->id }}, method: 'destroy' })" class="ml-4 text-red-500 hover:text-red-400">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center px-6 py-12 text-sm text-text-secondary">Belum ada item di toko.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($shopItems->hasPages())
            <div class="p-6 border-t border-border-color bg-bg-primary">
                {{ $shopItems->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
