<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <h1 class="text-3xl font-bold mb-6 text-white text-center sm:text-left">Dashboard</h1> <!-- Added responsive text alignment -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-500/20 mr-4">
                        <i class="fas fa-newspaper text-2xl text-teal-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-secondary">Total Berita</p>
                        <p class="text-2xl font-bold text-white">{{ $totalNews }}</p>
                    </div>
                </div>
            </div>
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-sky-500/20 mr-4">
                        <i class="fas fa-users text-2xl text-sky-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-secondary">Total Pengguna</p>
                        <p class="text-2xl font-bold text-white">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500/20 mr-4">
                        <i class="fas fa-globe text-2xl text-green-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-secondary">Pengunjung Situs</p>
                        <p class="text-2xl font-bold text-white">N/A</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <form wire:submit.prevent="saveSettings" class="glass-card rounded-xl">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-white mb-6 border-b border-border-color pb-4">Pengaturan Server</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-text-primary">Informasi Utama</h3>
                            <div>
                                <label for="server_name" class="block text-sm font-medium text-text-secondary">Nama Server</label>
                                <input type="text" wire:model.defer="settings.server_name" id="server_name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.server_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="minecraft_version" class="block text-sm font-medium text-text-secondary">Versi Minecraft</label>
                                <input type="text" wire:model.defer="settings.minecraft_version" id="minecraft_version" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.minecraft_version') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="server_ip" class="block text-sm font-medium text-text-secondary">IP Server</label>
                                <input type="text" wire:model.defer="settings.server_ip" id="server_ip" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.server_ip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                             <div>
                                <label for="server_description" class="block text-sm font-medium text-text-secondary">Deskripsi Server</label>
                                <textarea wire:model.defer="settings.server_description" id="server_description" rows="5" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"></textarea> <!-- Added px-3 py-2 -->
                                @error('settings.server_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-text-primary">Tautan & Media Sosial</h3>
                            <div>
                                <label for="discord_link" class="block text-sm font-medium text-text-secondary">Link Discord</label>
                                <input type="url" wire:model.defer="settings.discord_link" id="discord_link" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.discord_link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="whatsapp_link" class="block text-sm font-medium text-text-secondary">Link WhatsApp</label>
                                <input type="url" wire:model.defer="settings.whatsapp_link" id="whatsapp_link" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.whatsapp_link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="instagram_link" class="block text-sm font-medium text-text-secondary">Link Instagram</label>
                                <input type="url" wire:model.defer="settings.instagram_link" id="instagram_link" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.instagram_link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                             <h3 class="text-lg font-semibold text-text-primary pt-6">Pengaturan Situs</h3>
                             <div>
                                <label for="footer_copyright" class="block text-sm font-medium text-text-secondary">Teks Copyright Footer</label>
                                <input type="text" wire:model.defer="settings.footer_copyright" id="footer_copyright" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                                @error('settings.footer_copyright') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-bg-secondary/50 border-t border-border-color text-right rounded-b-xl flex justify-end"> <!-- Added flex justify-end -->
                    <button type="submit" class="btn btn-primary px-6 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
