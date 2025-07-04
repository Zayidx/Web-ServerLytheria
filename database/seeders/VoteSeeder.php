<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vote; // Pastikan model Vote di-import

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk menghindari duplikasi saat seeder dijalankan kembali
        Vote::truncate();

        Vote::create([
            'name' => 'Minecraft-MP.com',
            'description' => 'Platform voting terpopuler. Vote setiap hari untuk hadiah maksimal.',
            'hadiah' => 'Uang, Poin Rank, Crate Key',
            'url' => 'https://minecraft-mp.com/server/your-server-id/vote', // Ganti dengan URL vote Anda
        ]);

        Vote::create([
            'name' => 'TopMCServers.org',
            'description' => 'Bantu kami naik peringkat di daftar server terbaik dunia.',
            'hadiah' => 'Uang, Poin Rank, Item Langka',
            'url' => 'https://topmcservers.org/server/your-server-id', // Ganti dengan URL vote Anda
        ]);

        Vote::create([
            'name' => 'Planet-Minecraft.com',
            'description' => 'Komunitas kreatif yang besar. Dukung kami di sini!',
            'hadiah' => 'Uang, Poin Rank, Vote Point',
            'url' => 'https://www.planetminecraft.com/server/your-server-name/vote/', // Ganti dengan URL vote Anda
        ]);

        Vote::create([
            'name' => 'Minecraft-Server.net',
            'description' => 'Daftar server aktif dengan komunitas yang solid.',
            'hadiah' => 'Uang, Poin Rank, Diskon Toko',
            'url' => 'https://minecraft-server.net/vote/YourServerName/', // Ganti dengan URL vote Anda
        ]);
    }
}
