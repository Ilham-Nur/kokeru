<?php

namespace App\Http\Controllers\CS;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bukti;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // waktu 
        Carbon::setLocale('id');
        $time = Carbon::now()->formatLocalized("%A, %d %B %Y");
        
        // ambil jadwalnya dia
        $id = Auth::id();
        $jadwal = DB::table('jadwal')->where('id_user', $id)->get();

        $date = date('Y-m-d');
        $laporan = DB::select("SELECT lap.id, lap.id_jadwal, ruang.id AS id_ruang, ruang.nama_ruang, lap.created_at, users.nama_user 
            FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
            LEFT JOIN (SELECT * FROM laporan WHERE laporan.created_at LIKE '$date%') AS lap ON lap.id_jadwal = jadwal.id
            LEFT JOIN users ON users.id = jadwal.id_user WHERE users.id = '$id'");
        $bukti = DB::select("SELECT * FROM bukti WHERE created_at LIKE '$date%'");
        // dd($laporan);
        return view('cs.dashboard', [
            'time' => $time,
            'laporan' => $laporan,
            'bukti' => $bukti
        ]);
    }
}
