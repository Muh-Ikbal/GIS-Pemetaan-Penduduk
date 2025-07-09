<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@gis.com';

        // Cek apakah user sudah ada
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make('password123'), // Ganti dengan password aman
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin user berhasil dibuat.');
        } else {
            $this->command->info('Admin user sudah ada, tidak diubah.');
        }
    }
}
