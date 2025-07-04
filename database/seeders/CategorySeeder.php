<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Perintah truncate telah dipindahkan ke DatabaseSeeder.php
        // Category::truncate();

        $categories = [
            'Pembaruan Game',
            'Event Komunitas',
            'Info Server',
            'Maintenance',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                
                'description' => 'Berita dan pengumuman seputar ' . strtolower($category) . '.'
            ]);
        }
    }
}
