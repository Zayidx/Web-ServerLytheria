<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat saat seeding ulang
        Setting::truncate();

        $settings = [
            ['key' => 'server_name', 'value' => 'Lytheria SMP'],
            ['key' => 'minecraft_version', 'value' => '1.21.x'],
            ['key' => 'server_ip', 'value' => 'lytheria.online'],
            ['key' => 'discord_link', 'value' => 'https://discord.gg/4FDcU9juNZ'],
            ['key' => 'youtube_link', 'value' => 'https://youtube.com/your-channel'],
            ['key' => 'instagram_link', 'value' => 'https://www.instagram.com/lytheria.mc?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=='],
            ['key' => 'server_description', 'value' => 'Temukan petualangan epik, bangun mahakarya, dan jadilah bagian dari komunitas game terbaik di Indonesia.'],
            ['key' => 'footer_copyright', 'value' => '© ' . date('Y') . ' Lytheria SMP. Semua Hak Cipta Dilindungi. Tidak berafiliasi dengan Mojang AB.'],
            ['key' => 'logo_url', 'value' => 'https://i.ibb.co/C3knFmFY/logo.png'], // URL Logo
            ['key' => 'hero_background_image_url', 'value' => 'https://c4.wallpaperflare.com/wallpaper/721/291/800/minecraft-video-game-art-video-games-pc-gaming-landscape-hd-wallpaper-preview.jpg'], // URL Gambar Latar Belakang Hero
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
