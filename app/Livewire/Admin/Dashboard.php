<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use App\Models\News;
use App\Models\User;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-layout')]
class Dashboard extends Component
{
    public $totalNews;
    public $totalUsers;
    public $settings = [];

    // Metode untuk memuat semua data dashboard
    public function loadDashboardData()
    {
        $this->totalNews = News::count();
        $this->totalUsers = User::count();
        // Pastikan untuk memuat ulang pengaturan dari database
        $this->settings = Setting::pluck('value', 'key')->toArray();
    }

    public function mount()
    {
        $this->loadDashboardData(); // Panggil saat komponen pertama kali dimuat
    }

    protected function rules()
    {
        return [
            'settings.server_name' => 'required|string|max:255',
            'settings.minecraft_version' => 'required|string|max:50',
            'settings.server_ip' => 'required|string|max:255',
            'settings.discord_link' => 'nullable|url:http,https',
            'settings.whatsapp_link' => 'nullable|url:http,https',
            'settings.instagram_link' => 'nullable|url:http,https',
            'settings.footer_copyright' => 'required|string|max:255',
            'settings.server_description' => 'required|string',
        ];
    }

    protected function messages()
    {
        return [
            'settings.*.required' => 'Kolom ini wajib diisi.',
            'settings.*.string' => 'Kolom ini harus berupa teks.',
            'settings.*.max' => 'Input tidak boleh lebih dari :max karakter.',
            'settings.*.url' => 'Kolom ini harus berupa URL yang valid (contoh: https://example.com).',
        ];
    }

    public function saveSettings()
    {
        $this->validate();

        foreach ($this->settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        // Setelah menyimpan, muat ulang data dashboard untuk memastikan tampilan diperbarui
        $this->loadDashboardData(); 

        $this->dispatch('swal:success', [
            'message' => 'Pengaturan server berhasil diperbarui!'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}

