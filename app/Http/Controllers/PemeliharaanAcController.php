<?php

namespace App\Http\Controllers;

use App\Models\DataAc;
use App\Models\MaintananceAc;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeliharaanAcController extends Controller
{
    public function index($id_ruang)
    {
        $userId = Auth::id();

        $ruang = Ruang::findOrFail($id_ruang);

        $data_ac = DataAc::with(['dataAcs' => function ($query) use ($userId) {
            $query->where('mitra', $userId);
        }])->where('ruang_id', $id_ruang)->get();

        return view('mitraAc.pemeliharaan_ac.index', compact('id_ruang', 'data_ac', 'ruang'));
    }

    public function create($id_ruang, $id_ac)
    {
        $ruang = Ruang::findOrFail($id_ruang);
        $data_ac = DataAc::where('ruang_id', $id_ruang)->findOrFail($id_ac);
        $data_pemeliharaan = new MaintananceAc();

        return view('mitraAc.pemeliharaan_ac.create', compact('data_ac', 'ruang', 'id_ac', 'id_ruang', 'data_pemeliharaan'));
    }

    public function store($id_ruang, $id_ac, Request $request)
    {
        Ruang::findOrFail($id_ruang);
        DataAc::where('ruang_id', $id_ruang)->findOrFail($id_ac);

        $request->validate([
            'tanggal'       => 'required|date',
            'description'   => 'required',
            'arus'          => 'required|numeric',
            'tegangan'      => 'required|numeric',
            'tekanan'       => 'required|numeric',
            'remaks'        => 'required',
        ]);

        MaintananceAc::create([
            'data_ac_id'    => $id_ac,
            'mitra'         => Auth::id(),
            'tanggal'       => $request->tanggal,
            'description'   => $request->description,
            'arus'          => $request->arus,
            'tegangan'      => $request->tegangan,
            'tekanan'       => $request->tekanan,
            'remaks'        => $request->remaks,
        ]);

        return redirect()->route('mitra.pemeliharaan.index', $id_ruang)
            ->with('success', 'Data pemeliharaan berhasil disimpan.');
    }

    public function edit($id_ruang, $id_pemeliharaan, $id_ac)
    {
        $ruang = Ruang::findOrFail($id_ruang);
        $data_ac = DataAc::where('ruang_id', $id_ruang)->findOrFail($id_ac);
        $data_pemeliharaan = MaintananceAc::findOrFail($id_pemeliharaan);

        return view('mitraAc.pemeliharaan_ac.edit', compact('data_ac', 'ruang', 'id_ac', 'id_ruang', 'id_pemeliharaan', 'data_pemeliharaan'));
    }

    public function update()
    {
    }
}
