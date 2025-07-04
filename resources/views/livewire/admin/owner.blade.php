<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6"> <!-- Adjusted for stacking on small screens -->
            <h1 class="text-3xl font-bold text-white mb-4 sm:mb-0 text-center sm:text-left w-full sm:w-auto">Manajemen Owner</h1>
            <button wire:click="create()" class="btn btn-primary px-4 py-2 rounded-lg w-full sm:w-auto"> <!-- Added responsive width -->
                <i class="fas fa-plus mr-2"></i>Tambah Owner
            </button>
        </div>

        @if($isFormModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" x-data="{ open: @entangle('isFormModalOpen') }" x-show="open" @keydown.escape.window="open = false" style="display: none;"> <!-- Added responsive padding -->
            <div class="glass-card rounded-xl shadow-lg w-full max-w-full md:max-w-2xl max-h-[90vh] flex flex-col overflow-hidden" @click.away="open = false"> <!-- Adjusted max-w for mobile, added flex-col and overflow-hidden -->
                <form wire:submit.prevent="store" class="flex-1 flex flex-col">
                    <div class="p-6">
                        <div class="flex justify-between items-center pb-4 border-b border-border-color">
                            <h3 class="text-xl md:text-2xl font-bold text-white">{{ $ownerId ? 'Edit Owner' : 'Tambah Owner Baru' }}</h3> <!-- Responsive text size -->
                            <button type="button" wire:click="closeModal()" class="text-gray-400 hover:text-white text-3xl leading-none">&times;</button>
                        </div>
                    </div>
                    <div class="p-6 flex-1 overflow-y-auto"> <!-- Added flex-1 and overflow-y-auto -->
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm text-gray-300">Nama Owner</label>
                                <input type="text" id="name" wire:model.lazy="name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="job" class="block text-sm text-gray-300">Jabatan</label>
                                    <input type="text" id="job" wire:model.lazy="job" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"> <!-- Added px-3 py-2 -->
                                    @error('job') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="quote" class="block text-sm text-gray-300">Quotes</label>
                                    <input type="text" id="quote" wire:model.lazy="quote" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2"> <!-- Added px-3 py-2 -->
                                    @error('quote') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div>
                                <label for="profile_image_url" class="block text-sm text-gray-300">URL Gambar Profil (Opsional)</label>
                                <input type="text" id="profile_image_url" wire:model.lazy="profile_image_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2" placeholder="https://..."> <!-- Added px-3 py-2 -->
                                @error('profile_image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="skin_image_url" class="block text-sm text-gray-300">URL Gambar Skin (Opsional)</label>
                                <input type="text" id="skin_image_url" wire:model.lazy="skin_image_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2" placeholder="https://..."> <!-- Added px-3 py-2 -->
                                @error('skin_image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="head_skin_image_url" class="block text-sm text-gray-300">URL Gambar Kepala Skin (Opsional)</label>
                                <input type="text" id="head_skin_image_url" wire:model.lazy="head_skin_image_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white px-3 py-2" placeholder="https://..."> <!-- Added px-3 py-2 -->
                                @error('head_skin_image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Owner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Jabatan</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-bg-primary divide-y divide-border-color">
                        @forelse ($owners as $owner)
                        <tr class="hover:bg-gray-800/40 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $owner->profile_image_url ?: 'https://placehold.co/40x40/161B22/c9d1d9?text=' . substr($owner->name, 0, 1) }}" alt="{{ $owner->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">{{ $owner->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $owner->job }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $owner->id }})" class="text-teal-400 hover:text-teal-300">Edit</button>
                                <button wire:click="$dispatch('swal:confirm', { id: {{ $owner->id }}, method: 'destroyOwner' })" class="ml-4 text-red-500 hover:text-red-400">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-400">Tidak ada data owner ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $owners->links() }}
        </div>
    </div>
</div>
