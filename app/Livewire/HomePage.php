<?php

namespace App\Livewire;

use App\Models\Gamemode;
use App\Models\News;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomePage extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $gamemodes = Gamemode::all();
        // Mengambil 2 berita terbaru yang sudah di publish
        $news = News::where('status', 'published')->latest('published_at')->take(2)->get();
        
        return view('livewire.home-page', [
            'gamemodes' => $gamemodes,
            'news' => $news,
        ]);
    }
}
