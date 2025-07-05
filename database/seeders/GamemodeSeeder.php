<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gamemode;

class GamemodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gamemode::create([
            'name' => 'Survival RPG',
            'description' => 'Bertahan hidup di dunia yang luas dengan sistem level, skill unik, misi menantang, dan dungeon berbahaya. Kumpulkan sumber daya, buat perlengkapan legendaris, dan jadilah petualang terhebat.',
            'image_url' => 'https://i.ibb.co/tPsb4HgC/bghome.png',
        ]);

        Gamemode::create([
            'name' => 'Skyblock Galaxy',
            'description' => 'Mulai petualangan dari sebuah pulau kecil di angkasa. Kembangkan pulaumu, bangun generator otomatis, berdagang dengan pemain lain di pusat ekonomi, dan taklukkan tantangan untuk menjadi penguasa langit.',
            'image_url' => 'https://i.ibb.co/tPsb4HgC/bghome.png',
        ]);

        Gamemode::create([
            'name' => 'Creative Plots',
            'description' => 'Bebaskan imajinasimu di dunia tanpa batas. Dapatkan lahan pribadimu dan bangun apa pun yang kamu inginkan dengan akses ke semua blok dan item. Pamerkan mahakaryamu kepada seluruh komunitas.',
            'image_url' => 'https://i.ibb.co/tPsb4HgC/bghome.png',
        ]);
    }
}
