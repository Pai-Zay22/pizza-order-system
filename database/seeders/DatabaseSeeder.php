<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => 'NaungCho',
            'phone' => '09952511357',
            'role' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin123'),
       ]);
       User::create([
        'name' => 'htin',
        'email' => 'htin@gmail.com',
        'address' => 'NaungCho',
        'role' => 'admin',
        'phone' => '095278267',
        'gender' => 'male',
        'password' => Hash::make('htinlin123'),
   ]);
}
    }

