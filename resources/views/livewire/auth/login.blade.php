<div class="py-10 sm:py-24 bg-bg-primary text-text-primary font-poppins"> <!-- Adjusted vertical padding for responsiveness -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <div class="max-w-md mx-auto glass-card rounded-xl shadow-lg">
            <div class="p-6 sm:p-8"> <!-- Adjusted padding for responsiveness -->
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-white mb-2">Admin Login</h2> <!-- Responsive text size -->
                <p class="text-center text-gray-400 mb-6 sm:mb-8 text-sm sm:text-base">Selamat datang kembali, silakan masuk.</p> <!-- Responsive text size and margin -->
                <form wire:submit.prevent="login" class="space-y-4 sm:space-y-6"> <!-- Adjusted vertical spacing -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-secondary">Alamat Email</label>
                        <input wire:model="email" id="email" type="email" required class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-text-secondary">Kata Sandi</label>
                        <input wire:model="password" id="password" type="password" required class="mt-1 block w-full bg-gray-800 border-gray-700 rounded-md text-white focus:ring-accent-primary focus:border-accent-primary px-3 py-2"> <!-- Added px-3 py-2 -->
                        @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full btn btn-primary py-2 sm:py-3 rounded-lg"> <!-- Adjusted vertical padding for responsiveness -->
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
