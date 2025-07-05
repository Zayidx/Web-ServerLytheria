{{-- 
    File ini berisi tampilan untuk komponen ChatBot Livewire.
    Tidak ada perubahan signifikan dari kode asli Anda karena strukturnya sudah bagus.
    Hanya ditambahkan beberapa atribut wire:loading untuk meningkatkan feedback visual.
--}}
<div class="glass-card rounded-xl shadow-xl">
    <!-- Header Chatbot -->
    <div class="p-4 border-b border-gray-700 flex justify-between items-center">
        <h3 class="font-bold text-lg text-white">LytheriaBot Assistant</h3>
        
        <!-- Indikator Loading: Muncul saat pesan sedang dikirim dan diproses oleh AI -->
        <div wire:loading wire:target="sendMessage" class="text-xs text-gray-400 flex items-center gap-2">
            <svg class="animate-spin h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Mengetik...</span>
        </div>
        <!-- Status Online: Muncul saat tidak ada proses yang berjalan -->
        <div wire:loading.remove wire:target="sendMessage" class="text-xs text-gray-400 flex items-center gap-2">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
            <span>Online</span>
        </div>
    </div>

    <!-- Jendela Chat -->
    <div id="chat-window" 
         class="chat-window p-4 flex flex-col gap-4" 
         x-data 
         x-init="
            // Inisialisasi: scroll ke bawah saat pertama kali dimuat
            $el.scrollTop = $el.scrollHeight;
            // Pantau perubahan pada variabel 'messages' dari Livewire
            $watch('$wire.messages', () => {
                // Tunggu DOM diperbarui, lalu scroll ke paling bawah
                $nextTick(() => { $el.scrollTop = $el.scrollHeight });
            })
         ">
        
        {{-- Loop untuk menampilkan setiap pesan dalam riwayat --}}
        @forelse ($messages as $index => $message)
            <div wire:key="message-{{ $index }}" @class([
                'chat-bubble flex flex-col',
                'user self-end bg-blue-600 text-white' => $message['sender'] === 'user',
                'bot self-start bg-gray-700 text-gray-200' => $message['sender'] === 'bot',
            ])>
                <div>{!! \Illuminate\Support\Str::markdown($message['content']) !!}</div>
            </div>
        @empty
            <div class="text-center text-gray-500 text-sm">
                Belum ada percakapan. Mulai dengan mengetik pesan di bawah.
            </div>
        @endforelse
    </div>

    <!-- Form Input -->
    <div class="p-4 border-t border-gray-700">
        <form wire:submit.prevent="sendMessage" class="flex items-center gap-3">
            <input 
                type="text" 
                id="chat-input" 
                wire:model.defer="userInput"
                class="flex-grow bg-gray-800 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 w-full disabled:opacity-50"  
                placeholder="Ketik pertanyaanmu di sini..."
                autocomplete="off"
                wire:keydown.enter.prevent="sendMessage"
                wire:loading.attr="disabled" {{-- Nonaktifkan input saat loading --}}
                wire:target="sendMessage">
            
            <button 
                type="submit" 
                class="btn btn-primary rounded-lg px-5 py-3 text-white font-semibold flex items-center justify-center h-12 w-12 transition-all duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled" {{-- Nonaktifkan tombol saat loading --}}
                wire:target="sendMessage">
                {{-- Tampilkan ikon pesawat saat tidak loading --}}
                <i class="fas fa-paper-plane" wire:loading.remove wire:target="sendMessage"></i>
                {{-- Tampilkan spinner saat loading --}}
                <svg wire:loading wire:target="sendMessage" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>
    </div>
</div>

