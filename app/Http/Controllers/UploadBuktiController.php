<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Bukti;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UploadBuktiController extends Controller
{
    public function index($id_ruang)
    {
        Carbon::setLocale('id');
        $time = Carbon::now()->formatLocalized("%A, %d %B %Y");
        $last = Laporan::select('id')->orderByDesc('id')->limit(1)->get();
        return view('cs.upload_bukti', ['time' => $time, 'id_ruang' => $id_ruang, 'last' => $last]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                // 'id_lap' => 'required',
                // 'id_ruang' => 'required',
                'bukti' => 'required',
                'bukti.*' => 'mimes:jpg,png,jpeg,svg,mp4,mpeg,3gp,mkv|max:20000'
            ]);
            $id_jadwal = Jadwal::where('id_ruang', $request->id_ruang)->latest()->first();
            $laporan = Laporan::create([
                'id_jadwal' => $id_jadwal->id,
                'id_ruang' => $request->id_ruang
            ]);
            $files = [];
            if ($request->hasfile('bukti')) {
                foreach ($request->file('bukti') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('uploads'), $name);
                    $files[] = $name;

                }
            }
            // dd($files);
            foreach ($files as $filename) {
                $bukti = new Bukti();
                $bukti->id_laporan = $laporan->id;
                $bukti->nama_file = $filename;
                $bukti->deskripsi = $request->deskripsi; // tambah ini
                $bukti->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('cs.dashboard')
            ->with('success', 'Bukti laporan berhasil diupload');
    }
}
