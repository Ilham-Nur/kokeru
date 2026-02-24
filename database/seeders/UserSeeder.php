<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan Model User di-import
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // 1. Generate 20 user biasa (CS)
        for ($i = 1; $i <= 20; $i++) {
            $email = $faker->unique()->safeEmail;
            User::updateOrCreate(
                ['email' => $email], // Cek berdasarkan email
                [
                    'nama_user' => $faker->name,
                    'password' => Hash::make('password123'),
                    'manajer' => 0,
                    'mitra' => 0,
                ]
            );
        }

        // 2. MANAGER READ
        User::updateOrCreate(
            ['email' => 'managerread@gmail.com'],
            [
                'nama_user' => 'Manajer Read Only',
                'password' => Hash::make('manager123'),
                'manajer' => 1,
                'mitra' => 1,
            ]
        );

        // 3. MANAGER FULL
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nama_user' => 'Manajer Full',
                'password' => Hash::make('admin123321'),
                'manajer' => 1,
                'mitra' => 0,
            ]
        );

        // 4. MITRA
        User::updateOrCreate(
            ['email' => 'mitra@gmail.com'],
            [
                'nama_user' => 'Mitra',
                'password' => Hash::make('mitra1234'),
                'manajer' => 0,
                'mitra' => 1,
            ]
        );

        // 5. CS
        User::updateOrCreate(
            ['email' => 'cs@gmail.com'],
            [
                'nama_user' => 'Cleaning Service',
                'password' => Hash::make('cs123321'),
                'manajer' => 0,
                'mitra' => 0,
            ]
        );
    }
}