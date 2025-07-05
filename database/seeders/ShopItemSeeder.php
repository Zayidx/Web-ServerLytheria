<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShopItem;

class ShopItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopItem::truncate();

        // Discounts
        ShopItem::create([
            'name' => 'Paket Pemula',
            'price' => 45000,
            'original_price' => 60000,
            'image_url' => 'https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e',
            'category' => 'discount',
            'description' => 'Diskon 25% untuk paket pemula.'
        ]);
        ShopItem::create([
            'name' => 'Bundle Rank Knight',
            'price' => 40000,
            'original_price' => 50000,
            'image_url' => 'https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e',
            'category' => 'discount',
            'description' => 'Hemat 20% untuk bundle rank Knight.'
        ]);

        // Ranks
        ShopItem::create([
            'name' => 'Knight',
            'price' => 50000,
            'category' => 'rank',
            'description' => json_encode([
                'Kit Knight setiap 24 jam',
                'Akses ke /fly di lobi',
                'Prioritas masuk saat server penuh',
                'Nama dengan prefix [Knight]'
            ]),
        ]);
        ShopItem::create([
            'name' => 'Paladin',
            'price' => 100000,
            'category' => 'rank',
            'is_popular' => true,
            'description' => json_encode([
                'Semua keuntungan rank Knight',
                'Kit Paladin setiap 24 jam',
                'Akses ke /feed',
                '2x Poin Vote',
                'Nama dengan prefix [Paladin]'
            ]),
        ]);
        ShopItem::create([
            'name' => 'Emperor',
            'price' => 200000,
            'category' => 'rank',
            'description' => json_encode([
                'Semua keuntungan rank Paladin',
                'Kit Emperor setiap 24 jam',
                'Akses ke partikel eksklusif',
                '3x Poin Vote',
                'Nama dengan prefix [Emperor]'
            ]),
        ]);

        // Items
        ShopItem::create([
            'name' => 'Legendary Crate Key',
            'price' => 25000,
            'category' => 'item',
            'image_url' => 'https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e',
        ]);
        ShopItem::create([
            'name' => '1 Juta Uang In-Game',
            'price' => 15000,
            'category' => 'item',
            'image_url' => 'https://minecraft.wiki/images/Enchanted_Netherite_Sword.gif?ab61e',
        ]);
    }
}
