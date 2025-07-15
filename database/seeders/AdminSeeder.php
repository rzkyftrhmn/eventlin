<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'nama_admin' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin123'), // <- ini password aslinya
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Untuk info saat seeding
        echo "Admin Created:\n";
        echo "Email: admin@example.com\n";
        echo "Password: Admin123\n";
    }
}
