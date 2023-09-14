<?php
namespace App\Http\Controllers;

ini_set('max_execution_time', 360);

use App\Models\Laporan;
use App\Models\User;
use App\Models\Ruang;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function indexMan(Request $request)
    {
        if(isset($request->print)){ // pdf
            if($request->status==''){ // kalau default
                $tgl = date('Y-m-d');       
                $laporan = DB::select("SELECT lap.id_jadwal, ruang.nama_ruang, users.nama_user 
                    FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                    LEFT JOIN (SELECT * FROM laporan WHERE laporan.created_at LIKE '$tgl%') AS lap ON lap.id_jadwal = jadwal.id
                    LEFT JOIN users ON users.id = jadwal.id_user");
                $filename = 'kokeru_semua_'.$tgl.'.pdf';
            } else{ 
                $awal = $request->tanggal_mulai;
                $akhir = $request->tanggal_akhir;
                $akhirr = date('Y-m-d', strtotime($akhir. '+ 1 days'));
                $status = $request->status;
                $laporan = DB::select("SELECT lap.id_jadwal, ruang.nama_ruang, users.nama_user, date
                        FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                        LEFT JOIN (SELECT *, CAST(laporan.created_at AS DATE) as date FROM laporan WHERE laporan.created_at BETWEEN '$awal' AND '$akhirr') AS lap ON lap.id_jadwal = jadwal.id
                        LEFT JOIN users ON users.id = jadwal.id_user ORDER BY date DESC, ruang.id");
                $filename = 'kokeru_'.$status.'_'.$awal.'_'.$akhir.'.pdf';
            }
            $pdf = PDF::loadView('manajer.laporan-pdf', ['laporan' => $laporan, 'awal' => $awal, 'akhir' => $akhir, 'status' => $status]);
            return $pdf->stream($filename, array('Attachment' => false));
        } 
        elseif(isset($request->excel)){ // export csv excel
            if($request->status==''){ // kalau default
                $tgl = date('Y-m-d');       
                $laporan = DB::select("SELECT lap.id_jadwal, ruang.nama_ruang, users.nama_user 
                    FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                    LEFT JOIN (SELECT * FROM laporan WHERE laporan.created_at LIKE '$tgl%') AS lap ON lap.id_jadwal = jadwal.id
                    LEFT JOIN users ON users.id = jadwal.id_user");
                $filename = 'kokeru_semua_'.$tgl;
            } else{ 
                $awal = $request->tanggal_mulai;
                $akhir = $request->tanggal_akhir;
                $akhirr = date('Y-m-d', strtotime($akhir. '+ 1 days'));
                $status = $request->status;
                $laporan = DB::select("SELECT lap.id_jadwal, ruang.nama_ruang, users.nama_user, date
                        FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                        LEFT JOIN (SELECT *, CAST(laporan.created_at AS DATE) as date FROM laporan WHERE laporan.created_at BETWEEN '$awal' AND '$akhirr') AS lap ON lap.id_jadwal = jadwal.id
                        LEFT JOIN users ON users.id = jadwal.id_user ORDER BY date DESC, ruang.id");
                $filename = 'kokeru_'.$status.'_'.$awal.'_'.$akhir;
            }

            $header = ['nama_ruang', 'nama_cs', 'status'];
            $out = "";
            for ($i=0; $i<3 ; $i++) { 
                $out .= $header[$i].';';
            }
            $out .= "\n";
            if($request->status=='belum'){
                foreach ($laporan as $row) {
                    if(!isset($row->id_jadwal)){
                        $out .= "".$row->nama_ruang.";";
                        if (isset($row->nama_user)){
                            $out .= "".$row->nama_user.";";
                        } else{
                            $out .= "Belum ada cs;";
                        }
                        $out .= "Belum"; 
                        $out .= "\n";
                    }
                }
            } elseif($request->status=='sudah'){
                foreach ($laporan as $row) {
                    if(isset($row->id_jadwal)){
                        $out .= "".$row->nama_ruang.";";
                        if (isset($row->nama_user)){
                            $out .= "".$row->nama_user.";";
                        } else{
                            $out .= "Belum ada cs;";
                        }
                        $out .= "Sudah"; 
                        $out .= "\n";
                    }
                }
            } else{
                foreach ($laporan as $row) {
                    $out .= "".$row->nama_ruang.";";
                    if (isset($row->nama_user)){
                        $out .= "".$row->nama_user.";";
                    } else{
                        $out .= "Belum ada cs;";
                    }
                    if(isset($row->id_jadwal)){
                        $out .= "Sudah"; 
                    } else{
                        $out .= "Belum"; 
                    }
                    $out .= "\n";
                }
            }
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename= $filename.csv");
            header("Pragma: no-cache");
            header("Expires: 0");
            return $out;
        } else{
        //tampil data di halaman web
        if($request->status==''){
            $tgl = date('Y-m-d');       
            $laporan = DB::select("SELECT lap.id, lap.id_jadwal, ruang.id AS id_ruang, ruang.nama_ruang, lap.created_at, users.nama_user 
                FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                LEFT JOIN (SELECT * FROM laporan WHERE laporan.created_at LIKE '$tgl%') AS lap ON lap.id_jadwal = jadwal.id
                LEFT JOIN users ON users.id = jadwal.id_user");
            return view('manajer.laporan', ['laporan' => $laporan, 'awal'=> $tgl, 'akhir' => $tgl, 'status' => 'all']);
        } else{
            $awal = $request->tanggal_mulai;
            $akhir = $request->tanggal_akhir;
            $akhirr = date('Y-m-d', strtotime($akhir. '+ 1 days'));
            $status = $request->status;
            $laporan = DB::select("SELECT lap.id_jadwal, ruang.nama_ruang, users.nama_user, date
                        FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                        LEFT JOIN (SELECT *, CAST(laporan.created_at AS DATE) as date FROM laporan WHERE laporan.created_at BETWEEN '$awal' AND '$akhirr') AS lap ON lap.id_jadwal = jadwal.id
                        LEFT JOIN users ON users.id = jadwal.id_user ORDER BY date DESC, ruang.id");
            
            return view('manajer.laporan', ['laporan' => $laporan, 'awal'=> $awal, 'akhir' => $akhir,'status' => $status]);
        }
        }
        
    }

    public function laporan()
    {
        $date = date('Y-m-d');
        //$date = '2020-12-15';
        $count = Ruang::count();
        $laporan = DB::select("SELECT lap.id, lap.id_jadwal, ruang.id AS id_ruang, ruang.nama_ruang, lap.created_at, users.nama_user 
            FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
            LEFT JOIN (SELECT * FROM laporan WHERE laporan.created_at LIKE '$date%') AS lap ON lap.id_jadwal = jadwal.id
            LEFT JOIN users ON users.id = jadwal.id_user");
        $bukti = DB::select("SELECT * FROM bukti WHERE created_at LIKE '$date%'");
        return view('pages.home', ['laporan' => $laporan, 'count' => $count, 'bukti' => $bukti]);
    }

    public function manajer(){
        if(auth()->user()->manajer==1){
            $ruang = Ruang::count();
            $user = User::where('manajer',0)->count();
            $tgl = date('Y-m-d'); 
            $last = date('Y-m-d', strtotime($tgl. '+ 1 days'));
            $seven = date('Y-m-d', strtotime($last. '- 7 days'));
            $bersih = DB::select("SELECT COUNT(*) as jum
                FROM ruang LEFT JOIN jadwal ON ruang.id = jadwal.id_ruang
                LEFT JOIN (SELECT * FROM laporan WHERE laporan.created_at LIKE '$tgl%') AS lap ON lap.id_jadwal = jadwal.id
                LEFT JOIN users ON users.id = jadwal.id_user WHERE lap.id_jadwal IS NOT NULL");
            $kotor = $ruang-$bersih[0]->jum;
            $chart = DB::select("SELECT CAST(laporan.created_at AS DATE) AS label, 
                COUNT(laporan.id_jadwal) as frec FROM laporan where laporan.created_at BETWEEN '$seven' and '$last' GROUP BY 
                CAST(laporan.created_at AS DATE) ORDER BY label");
            return view('manajer.dashboard', ['ruang' => $ruang, 'user' => $user, 'bersih' => $bersih[0]->jum, 'kotor' => $kotor, 'chart' => $chart]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
}
