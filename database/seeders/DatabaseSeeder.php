<?php
// File: database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\News;
use App\Models\Category;
use App\Models\Owner;
use App\Models\Vote;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Nonaktifkan foreign key checks untuk mengizinkan truncate
        Schema::disableForeignKeyConstraints();

        // 2. Truncate semua tabel yang akan di-seed.
        // Urutan penting: tabel yang memiliki relasi (child) harus di-truncate dulu.
        News::truncate();
        Category::truncate();
        Owner::truncate();
        Vote::truncate();
        Setting::truncate();
        // Tambahkan truncate untuk tabel lain jika perlu.

        // 3. Aktifkan kembali foreign key checks
        Schema::enableForeignKeyConstraints();

        // 4. Panggil seeder lain untuk mengisi data.
        // Seeder-seeder ini sekarang TIDAK BOLEH memiliki perintah truncate lagi.
        $this->call([
            AdminUserSeeder::class,
            SettingSeeder::class,
            VoteSeeder::class,
            OwnerSeeder::class,
            CategorySeeder::class,
            NewsSeeder::class
        ]);
    }
}
