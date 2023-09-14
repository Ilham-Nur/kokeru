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
            'email' => 'manajer@gmail.com',
            'password' => bcrypt('admin1234'),
            'manajer' => true
        ]);

        // user
        // manajer
        DB::table('users')->insert([
            'nama_user' => 'hanjar',
            'email' => 'cs@gmail.com',
            'password' => bcrypt('cs1234'),
            'manajer' => false
        ]);
    }
}
