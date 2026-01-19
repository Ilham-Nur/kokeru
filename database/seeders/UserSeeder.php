<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 20; $i++){ 
    	    // insert data ke table user menggunakan Faker
    		DB::table('users')->insert([
    			'nama_user' => $faker->name,
    			'email' => $faker->email,
                'password' => $faker->password
            ]);
        }

        // manajer
        DB::table('users')->insert([
            'nama_user' => 'Manajer',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123321'),
            'manajer' => true
        ]);

        // user
        DB::table('users')->insert([
            'nama_user' => 'anam',
            'email' => 'cs@gmail.com',
            'password' => bcrypt('cs123321'),
            'manajer' => false
        ]);
        // mitra
        DB::table('users')->insert([
            'nama_user' => 'mitra',
            'email' => 'mitra@gmail.com',
            'password' => bcrypt('mitra1234'),
            'mitra' => true
        ]);
    }
}
