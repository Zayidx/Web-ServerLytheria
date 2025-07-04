<?php

// File: app/Livewire/Admin/Vote.php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Vote as VoteModel;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
class Vote extends Component
{
    use WithPagination;

    public $name, $url, $description, $hadiah, $voteId;
    public $isFormModalOpen = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'hadiah' => 'required|string|max:255',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama link vote wajib diisi.',
            'description.required' => 'Deskripsi link vote wajib diisi.',
            'url.required' => 'URL link vote wajib diisi.',
            'url.url' => 'Kolom URL harus berupa URL yang valid.',
            'hadiah.required' => 'Deskripsi hadiah wajib diisi.',
            '*.max' => 'Input tidak boleh lebih dari :max karakter.',
        ];
    }

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.admin.vote', [
            'votes' => VoteModel::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        $this->resetInput();
        $this->isFormModalOpen = true;
    }

    public function edit($id)
    {
        $vote = VoteModel::findOrFail($id);
        $this->voteId = $id;
        $this->name = $vote->name;
        $this->description = $vote->description;
        $this->url = $vote->url;
        $this->hadiah = $vote->hadiah;

        $this->isFormModalOpen = true;
    }

    public function store()
    {
        $validatedData = $this->validate();
        VoteModel::updateOrCreate(['id' => $this->voteId], $validatedData);

        $this->dispatch('swal:success', [
            'message' => $this->voteId ? 'Link Vote berhasil diperbarui.' : 'Link Vote baru berhasil dibuat.'
        ]);

        $this->closeModal();
    }

    #[On('destroyVote')]
    public function destroy($id)
    {
        VoteModel::find($id)->delete();
        $this->dispatch('swal:success', [
            'message' => 'Link Vote berhasil dihapus.'
        ]);
    }

    public function closeModal()
    {
        $this->isFormModalOpen = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->voteId = null;
        $this->name = '';
        $this->description = '';
        $this->url = '';
        $this->hadiah = '';
    }
}
