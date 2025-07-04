{{-- File: resources/views/livewire/admin/vote.blade.php --}}
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
   
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0 text-center sm:text-left w-full sm:w-auto">Kelola Link Vote</h1>
        <button wire:click="create()" class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto">
            <i class="fas fa-plus mr-2"></i>Tambah Link Baru
        </button>
    </div>

    @if($isFormModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" x-data="{ open: @entangle('isFormModalOpen') }" x-show="open" @keydown.escape.window="open = false" style="display: none;">
        <div class="glass-card rounded-xl shadow-lg w-full max-w-full md:max-w-2xl max-h-[90vh] flex flex-col overflow-hidden" @click.away="open = false">
            <form wire:submit.prevent="store" class="flex-1 flex flex-col">
                <div class="p-6">
                    <div class="flex justify-between items-center pb-4 border-b border-border-color">
                        <h3 class="text-xl md:text-2xl font-bold text-white">{{ $voteId ? 'Edit' : 'Tambah' }} Link Vote</h3>
                        <button type="button" wire:click="closeModal()" class="text-gray-400 hover:text-white text-3xl leading-none">&times;</button>
                    </div>
                </div>
                <div class="p-6 flex-1 overflow-y-auto">
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm text-gray-300">Nama Situs</label>
                            <input type="text" id="name" wire:model.lazy="name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="description" class="block text-sm text-gray-300">Deskripsi</label>
                            <input type="text" id="description" wire:model.lazy="description" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="hadiah" class="block text-sm text-gray-300">Hadiah</label>
                            <input type="text" id="hadiah" wire:model.lazy="hadiah" placeholder="Contoh: Uang, Poin Rank, Crate Key" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('hadiah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="url" class="block text-sm text-gray-300">URL</label>
                            <input type="url" id="url" wire:model.lazy="url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2">
                            @error('url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">No.</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Deskripsi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Hadiah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">URL</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-bg-primary divide-y divide-border-color">
                    @forelse ($votes as $vote)
                    <tr class="hover:bg-gray-800/40 transition">
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $vote->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $vote->description }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $vote->hadiah }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ $vote->url }}" target="_blank" class="text-blue-400 hover:text-blue-300 font-medium text-sm truncate block max-w-xs hover:underline">{{ $vote->url }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit({{ $vote->id }})" class="text-blue-400 hover:text-blue-300">Edit</button>
                            <button wire:click="$dispatch('swal:confirm', { id: {{ $vote->id }}, method: 'destroyVote' })" class="ml-4 text-red-500 hover:text-red-400">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-400">Tidak ada data link vote ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $votes->links() }}
    </div>
</div>
