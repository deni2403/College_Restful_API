<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Deni',
            'username' => 'deni2403',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Cindy',
            'username' => 'cindy2003',
            'password' => Hash::make('password'),
        ]);
    }
}
