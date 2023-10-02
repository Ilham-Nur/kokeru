<?php

namespace App\Http\Controllers;

use App\Models\DataAc;
use App\Models\Ruang;
use Illuminate\Http\Request;

class DataAcController extends Controller
{
    public function index($id_ruang){
        $ruang = Ruang::where('id', $id_ruang)->first();
        $data_ac = DataAc::where('ruang_id', $id_ruang)->get();
        // dd($id_ruang);
        return view('manajer.data_ac.index', compact('id_ruang', 'ruang','data_ac'));
    }
    public function create($id_ruang){
        $ruang = Ruang::where('id', $id_ruang)->first();
        $data_ac = new DataAc();
        return view('manajer.data_ac.create', compact('id_ruang', 'ruang', 'data_ac'));
    }
    public function store($id_ruang, Request $request){
        // dd($request->all());
        $request->validate([
            'no_seri'      => 'required',
            'jenis'         => 'required',
            'merk'          => 'required',
            'type'          => 'required',
            'kapasitas'     => 'required',
        ]);
        DataAc::create([
            'ruang_id'  => $id_ruang,
            'no_seri'   => $request->no_seri,
            'jenis'     => $request->jenis,
            'merk'      => $request->merk,
            'type'      => $request->type,
            'kapasitas' => $request->kapasitas,
        ]);
        
        return redirect()->route('data.ac.index', $id_ruang);
    }

    public function edit($id_ac, $id_ruang){
        $ruang = Ruang::where('id', $id_ruang)->first();
        $data_ac = DataAc::where('ruang_id', $id_ruang)->where('id', $id_ac)->first();
        return view('manajer.data_ac.edit', compact('id_ruang', 'ruang', 'data_ac', 'id_ac'));
    }

    public function update($id_ac, $id_ruang, Request $request){
        // dd($request->all());
        $request->validate([
            'no_seri'      => 'required',
            'jenis'         => 'required',
            'merk'          => 'required',
            'type'          => 'required',
            'kapasitas'     => 'required',
        ]);
        $data_ac = DataAc::where('ruang_id', $id_ruang)->where('id', $id_ac)->first();
        $data_ac->update([
            'ruang_id'  => $id_ruang,
            'no_seri'   => $request->no_seri,
            'jenis'     => $request->jenis,
            'merk'      => $request->merk,
            'type'      => $request->type,
            'kapasitas' => $request->kapasitas,
        ]);
        return redirect()->route('data.ac.index', $id_ruang);
    }
}
