<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            OwnerSeeder::class,
            NewsSeeder::class,
            VoteSeeder::class,
            GamemodeSeeder::class,
            ShopItemSeeder::class, // Tambahkan ini
        ]);
    }
}
