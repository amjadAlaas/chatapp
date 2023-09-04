<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'amjad1',
            'email' => 'amjad.alass94@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user2 = User::create([
            'name' => 'amjad2',
            'email' => 'amjadalaas94@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
