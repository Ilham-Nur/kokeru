<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 1; $i <= 80; $i++){ 
    	    // insert data ke table user menggunakan Faker
    		DB::table('ruang')->insert([
    			'nama_ruang' => 'R'.$i,
            ]);
        }
    }
}
