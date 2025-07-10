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
            'name' => 'Minecraft Pocket Servers',
            'description' => 'Bantu server kami menjadi yang teratas di daftar server Pocket Edition.',
            'hadiah' => 'Uang, Poin Rank, Crate Key',
            'url' => 'https://minecraftpocket-servers.com/server/130685/',
        ]);

        Vote::create([
            'name' => 'Minecraft-MP.com',
            'description' => 'Platform voting terpopuler. Vote setiap hari untuk hadiah maksimal.',
            'hadiah' => 'Uang, Poin Rank, Item Langka',
            'url' => 'https://minecraft-mp.com/server-s343087',
        ]);
    }
}
