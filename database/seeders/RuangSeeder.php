<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	for($i = 1; $i <= 80; $i++){ 
    	    // insert data ke table user menggunakan Faker
    		DB::table('ruang')->insert([
    			'nama_ruang' => 'R'.$i,
                'pj_ruang'   => $faker->name,
                'created_at'   => Carbon::now(),
            ]);
        }
    }
}
