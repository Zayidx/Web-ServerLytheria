<?php
namespace App\Livewire\Admin;

use App\Models\Owner as OwnerModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
class Owner extends Component 
{
    use WithPagination;

    public $name, $job, $quote, $profile_image_url, $skin_image_url, $head_skin_image_url, $ownerId;
    public $isFormModalOpen = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'job' => 'nullable|string|max:255',
            'quote' => 'nullable|string|max:255',
            'profile_image_url' => 'nullable|url',
            'skin_image_url' => 'nullable|url',
            'head_skin_image_url' => 'nullable|url',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama owner wajib diisi.',
            '*.url' => 'Kolom ini harus berupa URL yang valid.',
            '*.max' => 'Input tidak boleh lebih dari :max karakter.',
        ];
    }

    protected $paginationTheme = 'tailwind';

    public function render() 
    {
        return view('livewire.admin.owner', [
            'owners' => OwnerModel::latest()->paginate(10)
        ]);
    }

    public function create() 
    {
        $this->resetInput();
        $this->isFormModalOpen = true;
    }

    public function edit($id) 
    {
        $owner = OwnerModel::findOrFail($id);
        $this->ownerId = $id;
        $this->name = $owner->name;
        $this->job = $owner->job;
        $this->quote = $owner->quote;
        $this->profile_image_url = $owner->profile_image_url;
        $this->skin_image_url = $owner->skin_image_url;
        $this->head_skin_image_url = $owner->head_skin_image_url;
        $this->isFormModalOpen = true;
    }

    public function store() 
    {
        $validatedData = $this->validate();
        OwnerModel::updateOrCreate(['id' => $this->ownerId], $validatedData);
        
        $this->dispatch('swal:success', [
            'message' => $this->ownerId ? 'Data Owner berhasil diperbarui.' : 'Owner baru berhasil dibuat.'
        ]);

        $this->closeModal();
    }

    #[On('destroyOwner')]
    public function destroy($id) 
    {
        OwnerModel::find($id)->delete();
        $this->dispatch('swal:success', [
            'message' => 'Data Owner berhasil dihapus.'
        ]);
    }

    public function closeModal() 
    { 
        $this->isFormModalOpen = false; 
        $this->resetInput();
    }
    
    private function resetInput() 
    {
        $this->ownerId = null;
        $this->name = '';
        $this->job = '';
        $this->quote = '';
        $this->profile_image_url = '';
        $this->skin_image_url = '';
        $this->head_skin_image_url = '';
    }
}
