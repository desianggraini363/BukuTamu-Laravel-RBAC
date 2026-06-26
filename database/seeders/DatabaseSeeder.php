<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Buku Tamu',
            'nickname' => 'admin',
            'email' => 'desianggraini363@gmail.com', // Sesuai baris data uji pada gambar nomor 5
            'phone' => '085731775332',
            'password' => Hash::make('12345Desi'),
            'role' => 'admin',
        ]);
    }
}