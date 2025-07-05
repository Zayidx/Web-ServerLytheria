<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0 text-center sm:text-left w-full sm:w-auto">Manajemen Gamemode</h1>
            <button wire:click="create()" class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i>Tambah Gamemode
            </button>
        </div>

        @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" x-data="{ open: @entangle('isModalOpen') }" x-show="open" @keydown.escape.window="open = false" style="display: none;">
            <div class="glass-card rounded-xl shadow-lg w-full max-w-full md:max-w-2xl max-h-[90vh] flex flex-col overflow-hidden" @click.away="open = false">
                <form wire:submit.prevent="store" class="flex-1 flex flex-col">
                    <div class="p-6">
                        <div class="flex justify-between items-center pb-4 border-b border-border-color">
                            <h3 class="text-xl md:text-2xl font-bold text-white">{{ $gamemode_id ? 'Edit Gamemode' : 'Tambah Gamemode Baru' }}</h3>
                            <button type="button" wire:click="closeModal()" class="text-gray-400 hover:text-white text-3xl leading-none">&times;</button>
                        </div>
                    </div>
                    <div class="p-6 flex-1 overflow-y-auto space-y-4">
                        <div>
                            <label for="name" class="block text-sm text-gray-300">Nama Gamemode</label>
                            <input type="text" id="name" wire:model.defer="name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="description" class="block text-sm text-gray-300">Deskripsi</label>
                            <textarea id="description" wire:model.defer="description" rows="4" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"></textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="image_url" class="block text-sm text-gray-300">URL Gambar</label>
                            <input type="url" id="image_url" wire:model.live="image_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2" placeholder="https://...">
                            @error('image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                             @if ($image_url)
                                <p class="mt-2 text-xs text-text-secondary">Pratinjau Gambar:</p>
                                <img src="{{ $image_url }}" class="mt-2 h-20 w-auto rounded border border-border-color" alt="Image Preview">
                            @endif
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Gamemode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-bg-primary divide-y divide-border-color">
                        @forelse($gamemodes as $gamemode)
                        <tr class="hover:bg-gray-800/40 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-md object-cover" src="{{ $gamemode->image_url ?: 'https://placehold.co/40x40/161B22/c9d1d9?text=??' }}" alt="{{ $gamemode->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">{{ $gamemode->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300 max-w-md truncate">{{ $gamemode->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $gamemode->id }})" class="text-teal-400 hover:text-teal-300">Edit</button>
                                <button wire:click="$dispatch('swal:confirm', { id: {{ $gamemode->id }}, method: 'destroy' })" class="ml-4 text-red-500 hover:text-red-400">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center px-6 py-12 text-sm text-text-secondary">Belum ada gamemode yang ditambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             @if($gamemodes->hasPages())
            <div class="p-6 border-t border-border-color bg-bg-primary">
                {{ $gamemodes->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
