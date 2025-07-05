<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-white text-center sm:text-left">Dashboard</h1>

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

        <!-- System Actions -->
        <div class="mt-8">
            <div class="glass-card rounded-xl p-6">
                <h2 class="text-xl font-semibold text-white mb-4 border-b border-border-color pb-4">Tindakan Sistem</h2>
                
                <div class="space-y-4 divide-y divide-gray-700/50">
                    <!-- Update Project -->
                    <div class="flex items-center justify-between pt-4 first:pt-0">
                        <div>
                            <h3 class="text-lg font-semibold text-text-primary">Perbarui Proyek</h3>
                            <p class="text-sm text-text-secondary mt-1">Tarik perubahan terbaru dari branch `main` di GitHub.</p>
                        </div>
                        <button 
                            wire:click="updateProject" 
                            wire:confirm="Apakah Anda yakin ingin memperbarui proyek? Ini akan menarik kode terbaru dari GitHub dan dapat menyebabkan downtime sementara."
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="btn btn-secondary px-6 py-2 rounded-lg flex-shrink-0"
                        >
                            <span wire:loading.remove wire:target="updateProject">
                                <i class="fas fa-sync-alt mr-2"></i>
                                Perbarui Sekarang
                            </span>
                            <span wire:loading wire:target="updateProject">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Memperbarui...
                            </span>
                        </button>
                    </div>

                    <!-- Clear Cache -->
                    <div class="flex items-center justify-between pt-4">
                        <div>
                            <h3 class="text-lg font-semibold text-text-primary">Bersihkan Cache</h3>
                            <p class="text-sm text-text-secondary mt-1">Jalankan `php artisan optimize:clear` untuk membersihkan semua cache.</p>
                        </div>
                        <button 
                            wire:click="clearCache" 
                            wire:confirm="Anda yakin ingin membersihkan cache aplikasi?"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="btn bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex-shrink-0"
                        >
                            <span wire:loading.remove wire:target="clearCache">
                                <i class="fas fa-broom mr-2"></i>
                                Bersihkan Cache
                            </span>
                            <span wire:loading wire:target="clearCache">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Membersihkan...
                            </span>
                        </button>
                    </div>

                    <!-- Storage Link -->
                    <div class="flex items-center justify-between pt-4">
                        <div>
                            <h3 class="text-lg font-semibold text-text-primary">Buat Symlink Penyimpanan</h3>
                            <p class="text-sm text-text-secondary mt-1">Jalankan `php artisan storage:link` untuk membuat symlink ke folder penyimpanan publik.</p>
                        </div>
                        <button 
                            wire:click="runStorageLink" 
                            wire:confirm="Anda yakin ingin membuat symlink penyimpanan? Ini diperlukan agar file yang diunggah dapat diakses secara publik."
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="btn bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg flex-shrink-0"
                        >
                            <span wire:loading.remove wire:target="runStorageLink">
                                <i class="fas fa-link mr-2"></i>
                                Buat Symlink
                            </span>
                            <span wire:loading wire:target="runStorageLink">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Membuat...
                            </span>
                        </button>
                    </div>

                    <!-- Reset Database -->
                    <div class="flex items-center justify-between pt-4">
                        <div>
                            <h3 class="text-lg font-semibold text-red-500">Reset Database</h3>
                            <p class="text-sm text-text-secondary mt-1">Hapus semua data dan jalankan ulang migrasi & seeder. <span class="font-bold text-red-500">TINDAKAN BERBAHAYA.</span></p>
                        </div>
                        <button 
                            wire:click="resetDatabase" 
                            wire:confirm="ANDA YAKIN? Tindakan ini akan MENGHAPUS SEMUA DATA di database dan mengisinya dengan data awal. Tindakan ini tidak dapat diurungkan."
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="btn bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex-shrink-0"
                        >
                            <span wire:loading.remove wire:target="resetDatabase">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Reset Database
                            </span>
                            <span wire:loading wire:target="resetDatabase">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Mereset...
                            </span>
                        </button>
                    </div>
                </div>

                @if($commandOutput)
                <div class="mt-6">
                    <h4 class="text-md font-semibold text-text-primary">Hasil Perintah:</h4>
                    <pre class="bg-gray-900 text-white p-4 rounded-md mt-2 text-xs overflow-x-auto @if($commandStatus == 'error') text-red-400 @else text-green-400 @endif">{{ $commandOutput }}</pre>
                </div>
                @endif
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
                                <input type="text" wire:model.defer="settings.server_name" id="server_name" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.server_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="minecraft_version" class="block text-sm font-medium text-text-secondary">Versi Minecraft</label>
                                <input type="text" wire:model.defer="settings.minecraft_version" id="minecraft_version" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.minecraft_version') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="server_ip" class="block text-sm font-medium text-text-secondary">IP Server</label>
                                <input type="text" wire:model.defer="settings.server_ip" id="server_ip" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.server_ip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                             <div>
                                <label for="server_description" class="block text-sm font-medium text-text-secondary">Deskripsi Server</label>
                                <textarea wire:model.defer="settings.server_description" id="server_description" rows="5" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"></textarea>
                                @error('settings.server_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-text-primary">Tautan & Media Sosial</h3>
                            <div>
                                <label for="discord_link" class="block text-sm font-medium text-text-secondary">Link Discord</label>
                                <input type="url" wire:model.defer="settings.discord_link" id="discord_link" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.discord_link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="whatsapp_link" class="block text-sm font-medium text-text-secondary">Link WhatsApp</label>
                                <input type="url" wire:model.defer="settings.whatsapp_link" id="whatsapp_link" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.whatsapp_link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="instagram_link" class="block text-sm font-medium text-text-secondary">Link Instagram</label>
                                <input type="url" wire:model.defer="settings.instagram_link" id="instagram_link" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.instagram_link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                             <h3 class="text-lg font-semibold text-text-primary pt-6">Pengaturan Situs</h3>
                             <div>
                                <label for="logo_url" class="block text-sm font-medium text-text-secondary">URL Logo</label>
                                <input type="url" wire:model.defer="settings.logo_url" id="logo_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.logo_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="hero_background_image_url" class="block text-sm font-medium text-text-secondary">URL Background Gambar Hero</label>
                                <input type="url" wire:model.defer="settings.hero_background_image_url" id="hero_background_image_url" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.hero_background_image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                             <div>
                                <label for="footer_copyright" class="block text-sm font-medium text-text-secondary">Teks Copyright Footer</label>
                                <input type="text" wire:model.defer="settings.footer_copyright" id="footer_copyright" class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2">
                                @error('settings.footer_copyright') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-bg-secondary/50 border-t border-border-color text-right rounded-b-xl flex justify-end">
                    <button type="submit" class="btn btn-primary px-6 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
