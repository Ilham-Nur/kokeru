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
        $bulanAngka = Carbon::parse($bulan)->month;
        $ruang = Ruang::where('id', $id_ruang)->first();
        $tahun = Carbon::parse($ruang->created_at)->year;
        $sarana = InventarisSarana::where('ruang_id', $id_ruang)->get();
        // $saranas = InventarisSarana::with('inventarisKondisis')->where('ruang_id', $id_ruang)->get();

        $saranas = InventarisSarana::with(['inventarisKondisis' => function($query) use ($bulanAngka) {
            $query->where('bulan', $bulanAngka);
        }])->where('ruang_id', $id_ruang)->get();
        
        return view('cs.inventaris.inventaris_bulan', compact('bulan', 'tahun', 'ruang', 'sarana', 'saranas'));
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

    if ($manajer === null) {
        // Jika data sudah ada, perbarui data yang ada
        InventarisKondisi::create($data);
    } else {
        // Jika data belum ada, buat data baru
        $manajer->update($data);
    }
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
