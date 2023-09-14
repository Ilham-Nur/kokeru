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
    public function index($id_ruang){
        Carbon::setLocale('id');
        $time = Carbon::now()->formatLocalized("%A, %d %B %Y");
        $last = Laporan::select('id')->orderByDesc('id')->limit(1)->get();
        return view('cs.upload_bukti', ['time' => $time, 'id_ruang' => $id_ruang, 'last' => $last]);
    }

    public function store(Request $request){    
        $request->validate([
            'id_lap' => 'required',
            'id_ruang' => 'required',
            'bukti' => 'required',
            'bukti.*' => 'mimes:jpg,png,jpeg,svg,mp4,mpeg,3gp,mkv|max:20000'
        ]);    

        if($request->hasFile('bukti'))
        {   
            // input data ke tabel laporan dulu
            //$id_jadwal = DB::select("SELECT id FROM jadwal WHERE id_ruang = '$request->id_ruang'");
            $idlap = $request->id_lap+1;
            $id_jadwal = Jadwal::where('id_ruang', $request->id_ruang)->get();
            $laporan = DB::insert('insert into laporan (id, id_jadwal, created_at) values (?, ?, ?)', [$idlap, $id_jadwal[0]->id, Carbon::now()->toDateTimeString()]);
            //$laporan = Laporan::create([
                                        // 'id_jadwal' => $id_jadwal[0]->id,
                                        //  ]);

            if($laporan){ // jika berhasil insert data laporan
                $files = $request->file('bukti');
                
                foreach($files as $file){
                    $filename = Str::random(15).'.'.$file->extension();

                    // insert ke tabel bukti
                    $bukti = Bukti::create(['id_laporan' => $idlap,
                                            'nama_file' => $filename,
                                            ]);

                    if($bukti){ // jika berhasil insert, baru move foto ke penyimpanan server (di sini kutaruh di public/uploads)
                        $move = $file->move(public_path('uploads'), $filename);
                    }
                    
                }

                return redirect()->route('cs.dashboard')
                                 ->with('success','Bukti laporan berhasil diupload');
            } else{
                return back()->with('failed','Bukti gagal ditambahkan');
            }
        }
    }
            //dd("dapet");
            // $allowedfileExtension=['pdf','jpg','png','docx'];
            // $files = $request->file('foto');
            // foreach($files as $file){
            //     $filename = Str::random(15).'.'.$file->extension();
            //     $move = $file->move(public_path('uploads'), $filename);

                // $extension = $file->getClientOriginalExtension();
                // $check=in_array($extension,$allowedfileExtension);
                //dd($check);
                // if($check)
                // {
                    
                    // foreach ($request->foto as $photo) {
                    //     $filename = time()."_".$photo->getClientOriginalName();
                    //     Bukti::create([
                    //         'id_laporan' => $idlap,
                    //         'nama_file' => $filename
                    //         ]);
                    //         $tujuan = 'data_file';
                    //         $photo->move($tujuan,$filename);
                    //     }
                        // echo "Upload foto berhasil";
                    // }
                    // else
                    // {
                    //     echo '<div class="alert alert-warning"><strong>Warning!</strong> Foto tidak sesuai format</div>';
                    // }
            //     }
            // } 
                //return back()->with('failed','Data ruang gagal ditambahkan');
            
        // $videofileExtension=['mp4','mkv','mpeg','docx'];
        // $video = $request->file('video');
        // $filename = time()."_".$video->getClientOriginalName();
        // $extension = $video->getClientOriginalExtension();
        // $check=in_array($extension,$videofileExtension);
        // if($check){
        //     Bukti::create([
        //         'id_laporan' => $idlap,
        //         'nama_file' => $filename
        //         ]);
        //     $tujuan = 'data_file';
        //     $video->move($tujuan,$filename);
        //     echo "Upload Video Berhasil";
        // }
        // else{
        //     echo '<div class="alert alert-warning"><strong>Warning!</strong> Video tidak sesuai format</div>';
        // }
}
