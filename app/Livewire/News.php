<?php

namespace App\Livewire;

use App\Models\News as NewsModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class News extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $news = NewsModel::where('status', 'published')
                         ->latest('published_at')
                         ->paginate(9);

        return view('livewire.news', [
            'news' => $news,
        ]);
    }
}
