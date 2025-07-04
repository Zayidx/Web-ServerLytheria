<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Owner;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Perintah truncate telah dipindahkan ke DatabaseSeeder.php
        // Owner::truncate(); 

        Owner::create([
            'name' => 'Admin Lytheria',
            'job' => 'Server Administrator',
            'quote' => 'Membangun dunia yang lebih baik, satu blok pada satu waktu.',
            'profile_image_url' => 'https://i.ibb.co/PZpRPPgq/avatar-Head-1.png',
            'skin_image_url' => 'https://i.ibb.co/PZpRPPgq/avatar-Head-1.png',
            'head_skin_image_url' => 'https://i.ibb.co/PZpRPPgq/avatar-Head-1.png',
        ]);
    }
}
