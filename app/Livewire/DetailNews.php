<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class DetailNews extends Component
{
    public News $news;

    public function mount($slug)
    {
        $this->news = News::where('slug', $slug)
                          ->where('status', 'published')
                          ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.detail-news')
               ->title($this->news->title . ' - Lytheria SMP');
    }
}
