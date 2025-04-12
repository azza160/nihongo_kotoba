<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed user dengan peran admin
        User::create([
            'id' => Str::ulid(),
            'nama_pengguna' => 'adminku',
            'nama_lengkap' => 'Admin Utama',
            'email' => 'admin@example.com',
            'kata_sandi' => Hash::make('passwordadmin'), // bisa diganti sesuai kebutuhan
            'google_id' => null,
            'exp' => 0,
            'level_id' => 1,
            'peran' => 'admin',
            'foto' => null,
        ]);
    }
}
