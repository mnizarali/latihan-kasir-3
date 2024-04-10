<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'Admin123',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'Admin',
        ]);

        DB::table('users')->insert([
            'name' => 'petugas',
            'username' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'Petugas',
        ]);
    }
}
