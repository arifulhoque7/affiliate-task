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
     */
    public function run(): void
    {
        // admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'dob' => '2000-01-01',
            'type' => 1
        ]);

        // affiliate
        User::create([
            'name' => 'Affiliate',
            'email' => 'affiliate@gmail.com',
            'password' => Hash::make('123456'),
            'dob' => '2000-01-01',
            'type' => 2,
            'created_by' => 1,
        ]);

        // sub-affiliate
        User::create([
            'name' => 'Sub-affiliate',
            'email' => 'sub-affiliate@gmail.com',
            'password' => Hash::make('123456'),
            'dob' => '2000-01-01',
            'type' => 3,
            'created_by' => 1,
        ]);

        // normal user
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'dob' => '2000-01-01',
            'type' => 4,
        ]);
    }
}
