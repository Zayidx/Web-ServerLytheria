<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hanya buat admin default jika di lingkungan non-produksi
        // dan jika belum ada admin sama sekali.
        if (User::where('role', 'admin')->doesntExist()) {
            if (App::environment(['local', 'testing'])) {
                User::create([
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                ]);
                // Tampilkan pesan di konsol
                $this->command->info('Default admin user created with email: admin@example.com and password: password');
                $this->command->warn('This is for local development only. Please change the password immediately.');
                $this->command->comment('For production, it is recommended to use the "php artisan app:create-admin" command.');
            } else {
                // Di produksi, hanya tampilkan pesan untuk membuat admin secara manual.
                 $this->command->warn('No admin user found.');
                 $this->command->info('Please create an admin user by running the following command:');
                 $this->command->info('php artisan app:create-admin');
            }
        } else {
            $this->command->info('Admin user already exists. Skipping creation.');
        }
    }
}
