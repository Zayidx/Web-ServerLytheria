{{-- 
    File: resources/views/livewire/chat-bot.blade.php

    Catatan:
    - File ini sekarang bersih dari CSS inline.
    - Pastikan file CSS eksternal dan Font Awesome sudah dimuat di layout utama Anda.
    - Warna telah disesuaikan dengan tema biru modern.
--}}

<div>
    <div class="glass-card rounded-xl shadow-xl">
        <!-- Header Chatbot -->
        <div class="p-4 border-b border-gray-700 flex justify-between items-center">
            <h3 class="font-bold text-lg text-white">{{ $settings['server_name'] ?? 'Nilai Default' }}Bot Assistant</h3>
            
            <!-- Indikator Loading -->
            <div wire:loading wire:target="sendMessage" class="text-xs text-gray-400 flex items-center gap-2">
                <i class="fas fa-circle text-yellow-500 text-xs animate-pulse"></i> Mengetik...
            </div>
            <div wire:loading.remove wire:target="sendMessage" class="text-xs text-gray-400 flex items-center gap-2">
                <i class="fas fa-circle text-green-500 text-xs"></i> Online
            </div>
        </div>

        <!-- Jendela Chat -->
        <div id="chat-window" 
             class="chat-window p-4 flex flex-col gap-4" 
             x-data 
             x-init="$watch('$wire.messages', () => $nextTick(() => $el.scrollTop = $el.scrollHeight))">
            
            @foreach ($messages as $index => $message)
                <div wire:key="message-{{ $index }}" @class([
                    'chat-bubble',
                    'user' => $message['sender'] === 'user',
                    'bot' => $message['sender'] === 'bot',
                ])>
                    {{-- Menggunakan {!! !!} untuk merender HTML dari bot --}}
                    {!! $message['content'] !!}
                </div>
            @endforeach
        </div>

        <!-- Form Input -->
        <div class="p-4 border-t border-gray-700">
            <form wire:submit.prevent="sendMessage" class="flex gap-3">
                <input 
                    type="text" 
                    id="chat-input" 
                    wire:model.defer="userInput"
                    class="flex-grow bg-gray-800 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"  
                    placeholder="Ketik pertanyaanmu di sini..."
                    autocomplete="off"
                    wire:keydown.enter="sendMessage">
                
                <button 
                    type="submit" 
                    class="btn btn-primary rounded-lg px-5 py-3 text-white font-semibold"
                    wire:loading.attr="disabled"
                    wire:target="sendMessage">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>
