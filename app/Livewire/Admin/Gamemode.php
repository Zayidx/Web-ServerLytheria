<?php

namespace App\Livewire\Admin;

use App\Models\Gamemode as GamemodeModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
class Gamemode extends Component
{
    use WithPagination;

    public $name, $description, $image_url, $gamemode_id;
    public $isModalOpen = false;

    public function render()
    {
        $gamemodes = GamemodeModel::latest()->paginate(10);
        return view('livewire.admin.gamemode', [
            'gamemodes' => $gamemodes
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
        $this->name = '';
        $this->description = '';
        $this->image_url = '';
        $this->gamemode_id = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        GamemodeModel::updateOrCreate(['id' => $this->gamemode_id], [
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->image_url,
        ]);

        $this->dispatch('swal:success', [
            'message' => $this->gamemode_id ? 'Gamemode Berhasil Diperbarui.' : 'Gamemode Berhasil Dibuat.'
        ]);

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $gamemode = GamemodeModel::findOrFail($id);
        $this->gamemode_id = $id;
        $this->name = $gamemode->name;
        $this->description = $gamemode->description;
        $this->image_url = $gamemode->image_url;
        $this->openModal();
    }

    #[On('destroy')]
    public function destroy($id)
    {
        GamemodeModel::find($id)->delete();
        $this->dispatch('swal:success', [
            'message' => 'Gamemode Berhasil Dihapus.'
        ]);
    }
}
