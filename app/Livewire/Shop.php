<?php

namespace App\Livewire;

use App\Models\ShopItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Shop extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $items = ShopItem::where('status', 'active')->get();

        $discounts = $items->where('category', 'discount');
        $ranks = $items->where('category', 'rank')->sortBy('price');
        $otherItems = $items->where('category', 'item')->sortBy('price');

        return view('livewire.shop', [
            'discounts' => $discounts,
            'ranks' => $ranks,
            'otherItems' => $otherItems,
        ]);
    }
}
