<?php
namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
class CategoryNews extends Component 
{
    use WithPagination;

    public $name, $description, $categoryId;
    public $isFormModalOpen = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->categoryId,
            'description' => 'nullable|string',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah digunakan.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ];
    }

    public function render() 
    {
        return view('livewire.admin.category-news', [
            'categories' => Category::latest()->paginate(10)
        ]);
    }

    public function create() 
    {
        $this->resetInput();
        $this->isFormModalOpen = true;
    }

    public function edit($id) 
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->isFormModalOpen = true;
    }

    public function store() 
    {
        $validatedData = $this->validate();
        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
            'description' => $validatedData['description'],
        ]);
        
        $this->dispatch('swal:success', [
            'message' => $this->categoryId ? 'Kategori berhasil diperbarui.' : 'Kategori baru berhasil dibuat.'
        ]);

        $this->closeModal();
    }

    #[On('destroyCategory')]
    public function destroy($id) 
    {
        Category::find($id)->delete();
        $this->dispatch('swal:success', [
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }

    public function closeModal() 
    { 
        $this->isFormModalOpen = false;
        $this->resetInput();
    }

    private function resetInput() 
    {
        $this->categoryId = null;
        $this->name = '';
        $this->description = '';
    }
}
