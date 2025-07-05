<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Layout;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

#[Layout('components.layouts.admin-layout')]
class Dashboard extends Component
{
    public $totalNews;
    public $totalUsers;
    public $settings = [];
    public $commandOutput = '';
    public $commandStatus = ''; // 'success', 'error', ''

    public function loadDashboardData()
    {
        $this->totalNews = News::count();
        $this->totalUsers = User::count();
        $this->settings = Setting::pluck('value', 'key')->toArray();
    }

    public function mount()
    {
        $this->loadDashboardData();
    }

    private function runCommand(callable $command, $successMessage, $errorMessage)
    {
        $this->commandOutput = '';
        $this->commandStatus = '';
        try {
            $command($this);
            $this->commandStatus = 'success';
            $this->dispatch('swal:success', ['message' => $successMessage]);
        } catch (\Exception $e) {
            $this->commandOutput .= "An error occurred:\n";
            if ($e instanceof ProcessFailedException) {
                $this->commandOutput .= $e->getProcess()->getErrorOutput();
            } else {
                $this->commandOutput .= $e->getMessage();
            }
            $this->commandStatus = 'error';
            $this->dispatch('swal:error', ['message' => $errorMessage]);
        }
    }

    public function updateProject()
    {
        $this->runCommand(function ($component) {
            $path = base_path();
            $component->commandOutput .= "Starting project update...\n\n";

            $component->commandOutput .= "Running 'git pull origin main'...\n";
            (new Process(['git', 'pull', 'origin', 'main'], $path))->mustRun(function ($type, $buffer) use ($component) {
                $component->commandOutput .= $buffer;
            });

            $component->commandOutput .= "\nRunning 'composer install'...\n";
            (new Process(['composer', 'install', '--no-interaction', '--no-dev', '--prefer-dist'], $path))->mustRun(function ($type, $buffer) use ($component) {
                $component->commandOutput .= $buffer;
            });

            $component->commandOutput .= "\nRunning migrations...\n";
            Artisan::call('migrate', ['--force' => true]);
            $component->commandOutput .= Artisan::output();

            $component->commandOutput .= "\nClearing application caches...\n";
            Artisan::call('optimize:clear');
            $component->commandOutput .= Artisan::output() . "Caches cleared successfully.\n";

            $component->commandOutput .= "\nProject update completed successfully!";
        }, 'Proyek berhasil diperbarui dari GitHub!', 'Gagal memperbarui proyek.');
    }

    public function clearCache()
    {
        $this->runCommand(function ($component) {
            $component->commandOutput .= "Clearing application caches...\n";
            Artisan::call('optimize:clear');
            $component->commandOutput .= Artisan::output() . "Caches cleared successfully.\n";
        }, 'Cache berhasil dibersihkan!', 'Gagal membersihkan cache.');
    }

    public function resetDatabase()
    {
        $this->runCommand(function ($component) {
            $component->commandOutput .= "Resetting database...\n";
            Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
            $component->commandOutput .= Artisan::output() . "Database has been reset and seeded successfully.\n";
        }, 'Database berhasil direset!', 'Gagal mereset database.');
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
            'settings.logo_url' => 'nullable|url:http,https',
            'settings.hero_background_image_url' => 'nullable|url:http,https',
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
