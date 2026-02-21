<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Generate 20 user biasa (CS)
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'nama_user' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'manajer' => 0,
                'mitra' => 0,
            ]);
        }

        // ================================
        // MANAGER READ (manajer = 1, mitra = 1)
        // ================================
        DB::table('users')->insert([
            'nama_user' => 'Manajer Read Only',
            'email' => 'managerread@gmail.com',
            'password' => Hash::make('manager123'),
            'manajer' => 1,
            'mitra' => 1,
        ]);

        // ================================
        // MANAGER FULL (manajer = 1)
        // ================================
        DB::table('users')->insert([
            'nama_user' => 'Manajer Full',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123321'),
            'manajer' => 1,
            'mitra' => 0,
        ]);

        // ================================
        // MITRA
        // ================================
        DB::table('users')->insert([
            'nama_user' => 'Mitra',
            'email' => 'mitra@gmail.com',
            'password' => Hash::make('mitra1234'),
            'manajer' => 0,
            'mitra' => 1,
        ]);

        // ================================
        // CS
        // ================================
        DB::table('users')->insert([
            'nama_user' => 'Customer Service',
            'email' => 'cs@gmail.com',
            'password' => Hash::make('cs123321'),
            'manajer' => 0,
            'mitra' => 0,
        ]);
    }
}