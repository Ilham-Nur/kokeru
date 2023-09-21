<?php

namespace App\Http\Controllers;

use App\Models\InventarisSarana;
use App\Models\Jadwal;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class InventarisController extends Controller
{
    public function index()
    {

        return view('manajer.inventaris.index');
    }

    public function inventaris_bulan($id_ruang, $bulan)
    {
        $ruang = Ruang::where('id', $id_ruang)->first();
        $tahun = Carbon::parse($ruang->created_at)->year;
        $sarana = InventarisSarana::where('ruang_id', $id_ruang)->get();

        return view('manajer.inventaris.inventaris_bulan', compact('bulan', 'tahun', 'ruang', 'sarana'));
    }

    public function inventaris_sarana($id_ruang)
    {
        $ruang = Ruang::where('id', $id_ruang)->first();
        $sarana = InventarisSarana::where('ruang_id', $id_ruang)->latest()->get();
        return view('manajer.inventaris.inventaris_sarana', compact('id_ruang', 'ruang', 'sarana'));
    }

    public function create_inventaris_sarana($id_ruang)
    {
        $inventaris = new InventarisSarana();
        return view('manajer.inventaris.create_inventaris_sarana', compact('id_ruang', 'inventaris'));
    }

    public function store_inventaris_sarana(Request $request, $id_ruang)
    {
        $request->validate([
            'kode'  => 'required',
            'nama_sarana'  => 'required'
        ]);
        InventarisSarana::create([
            'ruang_id'  => $id_ruang,
            'kode' => $request->kode,
            'nama_sarana' => $request->nama_sarana
        ]);

        return redirect()->route('inventaris.sarana', $id_ruang);
    }

    public function edit_inventaris_sarana($id, $id_ruang)
    {
        $inventaris = InventarisSarana::where('id', $id)->first();
        return view('manajer.inventaris.edit_inventaris_sarana', compact('id', 'inventaris'));
    }

    public function update_inventaris_sarana($id, $id_ruang, Request $request)
    {
        $request->validate([
            'kode'  => 'required',
            'nama_sarana'  => 'required'
        ]);
        $inventaris_sarana = InventarisSarana::where('id', $id)->first();
        $inventaris_sarana->update([
            'ruang_id'  => $id_ruang,
            'kode' => $request->kode,
            'nama_sarana' => $request->nama_sarana
        ]);

        return redirect()->route('manajer.inventaris.edit_inventaris_sarana', $id_ruang);
    }

    public function destroy_inventaris_sarana($id)
    {
        $inventaris = InventarisSarana::where('id', $id)->first();
        $inventaris->delete();
        return redirect()->back();
    }

    // CS
    public function index_cs_inventaris()
    {
        $bulanList = [];
        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create(null, $i, 1);
            $bulanList[$i] = $date->format('F');
        }
        $idUser = Auth::user()->id;
        $ruang = Jadwal::where('id_user', $idUser)->latest()->get();

        return view('cs.inventaris.index', compact('ruang', 'bulanList'));
    }

    public function cs_inventaris_sarana($id_ruang)
    {
        $ruang = Ruang::where('id', $id_ruang)->first();
        $sarana = InventarisSarana::where('ruang_id', $id_ruang)->latest()->get();
        
        return view('cs.inventaris.inventaris_sarana', compact('id_ruang', 'ruang', 'sarana'));
    }

    public function cs_create_inventaris_sarana($id_ruang)
    {
        $inventaris = new InventarisSarana();
        return view('cs.inventaris.create_inventaris_sarana', compact('id_ruang', 'inventaris'));
    }

    public function cs_store_inventaris_sarana($id_ruang, Request $request)
    {
        $request->validate([
            'kode'  => 'required',
            'nama_sarana'  => 'required'
        ]);
        InventarisSarana::create([
            'ruang_id'  => $id_ruang,
            'kode' => $request->kode,
            'nama_sarana' => $request->nama_sarana
        ]);
        return redirect()->route('cs.inventaris.sarana', $id_ruang);
    }

    public function cs_edit_inventaris_sarana($id, $id_ruang)
    {
        $inventaris = InventarisSarana::where('id', $id)->first();
        return view('cs.inventaris.edit_inventaris_sarana', compact('id', 'inventaris', 'id_ruang'));
    }

    public function cs_update_inventaris_sarana($id, $id_ruang, Request $request)
    {
        $request->validate([
            'kode'  => 'required',
            'nama_sarana'  => 'required'
        ]);
        $inventaris_sarana = InventarisSarana::where('id', $id)->first();
        $inventaris_sarana->update([
            'ruang_id'  => $id_ruang,
            'kode' => $request->kode,
            'nama_sarana' => $request->nama_sarana
        ]);

        return redirect()->route('cs.inventaris.sarana', $id_ruang);
    }
    public function cs_destroy_inventaris_sarana($id)
    {
        $inventaris = InventarisSarana::where('id', $id)->first();
        $inventaris->delete();
        return redirect()->back();
    }
}
