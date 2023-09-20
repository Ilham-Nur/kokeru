<?php

namespace Database\Seeders;

use App\Models\InventarisSarana;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class InventarisSaranaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $materials = [
            'Batu Bata',
            'Semen Portland',
            'Pasir Kasar',
            'Pasir Halus',
            'Kayu Balok',
            'Kayu Plywood',
            'Baja Beton',
            'Besi Beton',
            'Genteng Beton',
            'Genteng Metal',
            'Atap Seng',
            'Cat Tembok',
            'Cat Kayu',
            'Paku',
            'Kaca Bangunan',
            'Kunci Pintu',
            'Pintu Kayu',
            'Jendela Aluminium',
            'Kabel Listrik',
            'Pipa PVC',
            'Pipa Besi',
            'Plaster Paris',
            'Keramik Lantai',
            'Keramik Dinding',
            'Gypsum Board',
            'Plafon Akustik',
            'Kawat Silet',
            'Teralis Jendela',
            'Reng',
            'Tutup Lubang',
            'Kran Air',
            'Keranjang Sampah',
            'Lantai Kayu',
            'Kerikil',
            'Lem Adhesive',
            'Lem Kayu',
            'Kertas Amplas',
            'Pisau Pahat',
            'Tang Potong Besi',
            'Kawat Las',
            'Tiang Listrik',
            'Lampu LED',
            'Lampu Bohlam',
            'Penggaris',
            'Roller Cat',
            'Sikat Cat',
            'Karpet',
            'Rak Dinding',
            'Sekrup',
            'Gergaji Kayu',
            'Gergaji Besi',
            'Gergaji Beton',
            'Batu Koral',
            'Pintu Garasi',
            'Kamera Pengawas',
            'Cetakan Beton',
            'Asbes',
            'Genteng Keramik',
            'Keramik Mozaik',
            'Pintu Geser',
            'Pintu Lipat',
            'Tangga Lipat',
            'Lubang Bor',
            'Kipas Angin',
            'Pisau Serut',
            'Palu',
            'Alat Las',
            'Pintu Kaca',
            'Pompa Air',
            'Katrol',
            'Tali',
            'Selang Air',
            'Obeng Listrik',
            'Kunci Inggris',
            'Gunting Besi',
            'Pengukur Laser',
            'Sikat Wire Brush',
            'Kunci L',
            'Gergaji Potong',
            'Tape Meter',
            'Mortar',
            'Semen Instan',
            'Batu Split',
            'Keramik 3D',
            'Pintu Lipat Geser',
            'Kamera Keamanan',
            'Genteng Aspal',
            'Kawat Galvanis',
            'Pipa Galvanis',
            'Water Heater',
            'Kotak Listrik',
            'Stop Kontak',
            'Lampu Emergensi',
            'Batu Paving',
            'Selang Gas',
            'Tangga Lipat Alumunium',
            'Kawat Harmonika',
        ];

        foreach ($materials as $material) {
            InventarisSarana::create([
                'ruang_id' => $faker->numberBetween(1, 20),
                'kode' => 'S-' . $faker->unique()->ean8,
                'nama_sarana' => $material,
            ]);
        }

       
    }
}
