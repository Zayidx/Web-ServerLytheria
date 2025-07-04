<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Vote as VoteModel; // Pastikan model di-import

#[Layout('components.layouts.app')]
class Vote extends Component
{
    public function render()
    {
        // Mengambil semua data vote dari database
        $votes = VoteModel::latest()->get();

        // Mengirim data ke view
        return view('livewire.vote', [
            'votes' => $votes
        ]);
    }
}
