<?php

namespace App\Http\Controllers;

use App\Models\InventarisKondisi;
use App\Models\InventarisSarana;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventarisKondisiController extends Controller
{
    public function cs_index ($id_ruang, $bulan)
    {
        $ruang = Ruang::where('id', $id_ruang)->first();
        $tahun = Carbon::parse($ruang->created_at)->year;
        $sarana = InventarisSarana::where('ruang_id', $id_ruang)->get();
        // $inventaris_kondisi = InventarisKondisi::where('inventaris_sarana_id', $sarana->id);
        // dd($inventaris_kondisi);
        return view('cs.inventaris.inventaris_bulan', compact('bulan', 'tahun', 'ruang', 'sarana'));
    }
    public function cs_store($id_sarana, $bulan, Request $request){
        $bulanAngka = Carbon::parse($bulan)->month;
        $request->validate([
            'kuantiti' => 'required|numeric',
            'kondisi' => 'required|numeric',
            'dipinjam' => 'required|numeric',
            'mutasi' => 'required|numeric',
            'user' => 'required|numeric',
            'sign' => 'required|numeric'
        ]);

        $data = [
            'bulan' => $bulanAngka,
            'kuantiti' => $request->kuantiti,
            'kondisi' => $request->kondisi,
            'dipinjam' => $request->dipinjam,
            'mutasi' => $request->mutasi,
            'user' => $request->user,
            'sign' => $request->sign
        ];

        InventarisKondisi::updateOrCreate(
            ['inventaris_sarana_id' => $id_sarana], $data 
        );
        return redirect()->back();
    }

    public function manajer_store($id_sarana, $bulan, Request $request){
        $bulanAngka = Carbon::parse($bulan)->month;
        $request->validate([
            'kuantiti' => 'required|numeric',
            'kondisi' => 'required|numeric',
            'dipinjam' => 'required|numeric',
            'mutasi' => 'required|numeric',
            'user' => 'required|numeric',
            'sign' => 'required|numeric'
        ]);

        $data = [
            'inventaris_sarana_id' => $id_sarana,
            // 'ruang_id' => $id_ruang,
            'bulan' => $bulanAngka,
            'kuantiti' => $request->kuantiti,
            'kondisi' => $request->kondisi,
            'dipinjam' => $request->dipinjam,
            'mutasi' => $request->mutasi,
            'user' => $request->user,
            'sign' => $request->sign
        ];

          // Cek apakah data dengan bulan yang sama sudah ada dalam database
    $manajer = InventarisKondisi::where('bulan', $bulanAngka)
    ->where('inventaris_sarana_id', $id_sarana)
    // ->where('ruang_id', $id_ruang)
    ->first();
    // $sarana = InventarisSarana::where('ruang_id', $id_ruang)->first();

    // dd($manajer);

    // dd($manajer->bulan === $bulanAngka);
// dd($manajer->bulan === $bulanAngka);
    if ($manajer === null) {
        // Jika data sudah ada, perbarui data yang ada
        InventarisKondisi::create($data);
    } else {
        // Jika data belum ada, buat data baru
        $manajer->update($data);
    }
        
        // InventarisKondisi::updateOrCreate(
        //     ['inventaris_sarana_id' => $id_sarana], $data 
        // );
        return redirect()->back();
    }
}
