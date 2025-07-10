<?php

namespace App\Livewire;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class DetailNews extends Component
{
    /**
     * Berita utama yang sedang ditampilkan.
     * @var \App\Models\News
     */
    public News $news;

    /**
     * Koleksi berita lain untuk ditampilkan di sidebar.
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public Collection $otherNews;

    /**
     * Inisialisasi komponen dengan mengambil data berita utama
     * dan berita terkait berdasarkan slug.
     *
     * @param string $slug
     * @return void
     */
    public function mount($slug)
    {
        // Ambil berita utama berdasarkan slug, atau tampilkan 404 jika tidak ditemukan.
        $this->news = News::where('slug', $slug)
                          ->where('status', 'published')
                          ->firstOrFail();

        // Ambil berita lain untuk sidebar.
        // Prioritas: berita dari kategori yang sama, kemudian diisi berita terbaru lainnya.
        $this->otherNews = News::where('status', 'published')
                                 // Kecualikan berita yang sedang dibuka
                                 ->where('id', '!=', $this->news->id)
                                 // Urutkan berdasarkan kesamaan kategori, lalu tanggal terbaru
                                 ->orderByRaw('CASE WHEN category_id = ? THEN 1 ELSE 2 END', [$this->news->category_id])
                                 ->latest('published_at')
                                 // Batasi jumlah berita di sidebar
                                 ->take(4)
                                 ->get();
    }

    /**
     * Render komponen view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Judul halaman akan secara otomatis menggunakan judul berita.
        // Fungsi html_entity_decode akan digunakan di view untuk membersihkan judul.
        return view('livewire.detail-news')
               ->title(html_entity_decode($this->news->title) . ' - ' . config('app.name', 'Laravel'));
    }
}
