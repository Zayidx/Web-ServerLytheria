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
        // Hapus gamemode lama jika perlu untuk menghindari duplikat
        Gamemode::query()->delete();

        Gamemode::create([
            'name' => 'Survival Economy',
            'description' => 'Fokus pada perdagangan, pekerjaan, dan membangun kekayaan. Dirikan toko, kuasai pasar, dan jadilah taipan server.',
            'image_url' => 'https://media.discordapp.net/attachments/1360999648508117144/1392549316182282412/2025-07-01_14_-_Imgur.jpg?ex=686ff01d&is=686e9e9d&hm=f89fc20e037c6317f3fb04329a0e596d2e87057c2b305d38a9b118864c27cc1a&=&format=webp&width=1362&height=766',
        ]);


        Gamemode::create([
            'name' => 'Factions',
            'description' => 'Bentuk klan, bangun markas, dan nyatakan perang terhadap faksi lain. Dominasi wilayah, rampas sumber daya, dan jadilah faksi terkuat.',
            'image_url' => 'https://media.discordapp.net/attachments/1360999648508117144/1392549315829956609/2025-05-17_16_-_Imgur.jpg?ex=686ff01d&is=686e9e9d&hm=6184cd7c2f3fa41352bd1007bd87b4172e7b49404054121152463f0fe31e3ccc&=&format=webp&width=1362&height=766',
        ]);

        Gamemode::create([
            'name' => 'Creative',
            'description' => 'Bebaskan imajinasimu di dunia tanpa batas. Dapatkan lahan pribadimu dan bangun apa pun yang kamu inginkan dengan akses ke semua blok dan item. Pamerkan mahakaryamu kepada seluruh komunitas.',
            'image_url' => 'https://media.discordapp.net/attachments/1360999648508117144/1392549315439890432/undefined_-_Imgur.jpg?ex=686ff01d&is=686e9e9d&hm=9350e162f82016246c0d27fec4cbbd0296d27a0eccfe307ed9bfeee6a17e0019&=&format=webp&width=1362&height=766',
        ]);
    }
}
