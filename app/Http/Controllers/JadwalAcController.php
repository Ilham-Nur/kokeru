<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalAcController extends Controller
{
    public function index_manajer(){
        return view('manajer.pemeliharaan_ac.jadwal');
    }
}
