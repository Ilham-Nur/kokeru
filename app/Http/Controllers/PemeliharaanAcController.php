<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class PemeliharaanAcController extends Controller
{
    public function index($id_ruang){
        $ruang = Ruang::where('id', $id_ruang)->first();
        return view('manajer.pemeliharaan_ac.index', compact('id_ruang', 'ruang'));
    }
}
