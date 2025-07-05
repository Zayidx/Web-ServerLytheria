<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ShopItem;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
class Shop extends Component
{
    use WithPagination;

    public $isModalOpen = false;
    public $itemId, $name, $description, $price, $original_price, $image_url, $category, $is_popular, $status;
    public $features = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gt:price',
            'image_url' => 'nullable|url',
            'category' => 'required|in:discount,rank,item',
            'is_popular' => 'boolean',
            'status' => 'required|in:active,inactive',
            'features.*.value' => 'nullable|string',
        ];
    }

    public function render()
    {
        $shopItems = ShopItem::latest()->paginate(10);
        return view('livewire.admin.shop', [
            'shopItems' => $shopItems,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->itemId = null;
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->original_price = null;
        $this->image_url = '';
        $this->category = 'item';
        $this->is_popular = false;
        $this->status = 'active';
        $this->features = [['value' => '']];
    }

    public function addFeature()
    {
        $this->features[] = ['value' => ''];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function store()
    {
        $this->validate();

        $itemDescription = $this->description;
        if ($this->category === 'rank') {
            $itemDescription = json_encode(collect($this->features)->pluck('value')->filter()->values());
        }

        ShopItem::updateOrCreate(['id' => $this->itemId], [
            'name' => $this->name,
            'description' => $itemDescription,
            'price' => $this->price,
            'original_price' => $this->original_price,
            'image_url' => $this->image_url,
            'category' => $this->category,
            'is_popular' => $this->is_popular,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:success', [
            'message' => $this->itemId ? 'Item berhasil diperbarui.' : 'Item berhasil dibuat.'
        ]);

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $item = ShopItem::findOrFail($id);
        $this->itemId = $id;
        $this->name = $item->name;
        $this->price = (int)$item->price;
        $this->original_price = $item->original_price ? (int)$item->original_price : null;
        $this->image_url = $item->image_url;
        $this->category = $item->category;
        $this->is_popular = $item->is_popular;
        $this->status = $item->status;

        if ($this->category === 'rank') {
            $decodedFeatures = json_decode($item->description, true);
            $this->features = is_array($decodedFeatures) ? collect($decodedFeatures)->map(fn ($value) => ['value' => $value])->toArray() : [];
            if (empty($this->features)) {
                $this->features = [['value' => '']];
            }
            $this->description = '';
        } else {
            $this->description = $item->description;
            $this->features = [['value' => '']];
        }

        $this->openModal();
    }

    #[On('destroy')]
    public function destroy($id)
    {
        ShopItem::find($id)->delete();
        $this->dispatch('swal:success', [
            'message' => 'Item berhasil dihapus.'
        ]);
    }
}
