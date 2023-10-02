<?php

namespace App\Http\Controllers;

use App\Models\DataAc;
use App\Models\MaintananceAc;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class PemeliharaanAcController extends Controller
{
    public function index($id_ruang){
        // $data_ac = DataAc::with('dataAcs')->where('ruang_id', $id_ruang)->latest()->get();
        $data_user = Auth::user()->id;
        $userId = Auth::user()->id;
        $data_ac = DataAc::with(['dataAcs' => function ($query) use ($userId) {
            $query->where('mitra', $userId);
        }])->where('ruang_id', $id_ruang)->get();

        return view('mitraAc.pemeliharaan_ac.index', compact('id_ruang', 'data_ac'));
    }

    public function create($id_ruang, $id_ac){
        $ruang = Ruang::where('id', $id_ruang)->first();
        $data_ac = DataAc::where('ruang_id', $id_ruang)->where('id', $id_ac)->first();
        $data_pemeliharaan = new MaintananceAc();
        return view('mitraAc.pemeliharaan_ac.create', compact('data_ac', 'ruang', 'id_ac', 'id_ruang', 'data_pemeliharaan'));
    }

    public function store($id_ruang, $id_ac, Request $request){
        $request->validate([
            'tanggal'       => 'required',
            'description'   => 'required',
            'arus'          => 'required',
            'tegangan'      => 'required',
            'tekanan'       => 'required',
            'remaks'        => 'required',
        ]);

        $userId = Auth::user()->id;
        MaintananceAc::create([
            'data_ac_id'    => $id_ac,
            'mitra'         => $userId,
            'tanggal'       => $request->tanggal,
            'description'   => $request->description,
            'arus'          => $request->arus,
            'tegangan'      => $request->tegangan,
            'tekanan'       => $request->tekanan,
            'remaks'        => $request->remaks,
        ]);

        return redirect()->route('mitra.pemeliharaan.index', $id_ruang);
    }

    public function edit($id_ruang,$id_pemeliharaan, $id_ac){
        $ruang = Ruang::where('id', $id_ruang)->first();
        $data_ac = DataAc::where('ruang_id', $id_ruang)->where('id', $id_ac)->first();
        $data_pemeliharaan = MaintananceAc::where('id', $id_pemeliharaan)->first();
        // dd($data_pemeliharaan);
        return view('mitraAc.pemeliharaan_ac.edit', compact('data_ac', 'ruang', 'id_ac', 'id_ruang','id_pemeliharaan', 'data_pemeliharaan'));
    }

    public function update(){

    }
}
