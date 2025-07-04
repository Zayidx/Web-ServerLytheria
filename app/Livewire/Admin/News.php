<?php
namespace App\Livewire\Admin;

use App\Models\News as NewsModel;
use App\Models\Category;
use App\Models\Owner;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-layout')]
class News extends Component 
{
    use WithPagination;

    public $title, $content, $newsId, $imageUrl, $imageCaption, $status = 'draft', $categoryId, $ownerId;
    public $isFormModalOpen = false;

    protected $rules = [
        'title' => 'required|string|min:5',
        'categoryId' => 'required|exists:categories,id',
        'ownerId' => 'required|exists:owners,id',
        'status' => 'required|in:draft,published',
        'imageUrl' => 'nullable|url',
        'imageCaption' => 'nullable|string|max:255',
        'content' => 'required|string|min:20',
    ];

    protected function messages()
    {
        return [
            'title.required' => 'Judul berita wajib diisi.',
            'title.min' => 'Judul berita minimal harus 5 karakter.',
            'categoryId.required' => 'Kategori wajib dipilih.',
            'ownerId.required' => 'Penulis wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
            'content.required' => 'Konten berita tidak boleh kosong.',
            'content.min' => 'Konten berita minimal harus 20 karakter.',
            'imageUrl.url' => 'URL gambar tidak valid.',
            'imageCaption.max' => 'Keterangan gambar tidak boleh lebih dari 255 karakter.',
        ];
    }
    
    protected $paginationTheme = 'tailwind';

    public function render() 
    {
        return view('livewire.admin.news', [
            'news' => NewsModel::with(['category', 'owner'])->latest()->paginate(10),
            'categories' => Category::all(),
            'owners' => Owner::all(),
        ]);
    }

    public function create() 
    {
        $this->resetInput();
        $this->isFormModalOpen = true;
        // Mengirim event dengan data kosong untuk editor baru
        $this->dispatch('initialize-editor', content: '');
    }

    public function edit($id) 
    {
        $news = NewsModel::findOrFail($id);
        $this->newsId = $id;
        $this->title = $news->title;
        $this->content = $news->content;
        $this->imageUrl = $news->image_url;
        $this->imageCaption = $news->image_caption;
        $this->status = $news->status;
        $this->categoryId = $news->category_id;
        $this->ownerId = $news->owner_id;
        $this->isFormModalOpen = true;
        // Mengirim event dengan konten yang ada untuk diedit
        $this->dispatch('initialize-editor', content: $this->content);
    }

    public function store() 
    {
        $validatedData = $this->validate();
        NewsModel::updateOrCreate(['id' => $this->newsId], [
            'title' => $validatedData['title'],
            'slug' => \Illuminate\Support\Str::slug($validatedData['title']),
            'category_id' => $validatedData['categoryId'],
            'owner_id' => $validatedData['ownerId'],
            'status' => $validatedData['status'],
            'image_url' => $validatedData['imageUrl'],
            'image_caption' => $validatedData['imageCaption'],
            'content' => $validatedData['content'],
        ]);
        
        $this->dispatch('swal:success', [
            'message' => $this->newsId ? 'Berita berhasil diperbarui.' : 'Berita berhasil dibuat.'
        ]);

        $this->isFormModalOpen = false;
        $this->resetInput();
    }

    #[On('destroy')] 
    public function destroy($id) 
    {
        NewsModel::find($id)->delete();
        $this->dispatch('swal:success', [
            'message' => 'Berita berhasil dihapus.'
        ]);
    }

    private function resetInput() 
    {
        $this->newsId = null; $this->title = ''; $this->content = ''; $this->imageUrl = '';
        $this->imageCaption = ''; $this->status = 'draft'; $this->categoryId = ''; $this->ownerId = '';
    }
}
