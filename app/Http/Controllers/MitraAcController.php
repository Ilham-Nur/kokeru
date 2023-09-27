<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MitraAcController extends Controller
{
   public function index_manajer(){
      $mitra = User::where('mitra', 1)->latest()->get();
    return view('manajer.mitra-ac', compact('mitra'));
   }

   public function store(Request $request)
    {
      // dd($request->all());
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required',
        ]);
        
        $rand = Str::random(8);
        $pw = bcrypt($rand);
        $store = User::create([
         'nama_user'    => $request->nama_user,
         'email'        => $request->email,
         'password'     => $pw,
         'mitra'        => 1,
        ]);
        if($store){
            $details = [
                'title'    => 'Akun Cleaning Service Universitas Ibnu Sina',
                'nama'     => $request->nama_user,
                'email'    => $request->email,
                'pass'     => $rand,
            ];
            // send email
            \Mail::to($request->email)->send(new \App\Mail\SendPassword($details));

            return redirect()->route('manajer.mitra.index')
                             ->with('success','Data cs berhasil ditambahkan');
        } else{
            return redirect()->route('manajer.mitra.index')
                             ->with('failed','Data cs gagal ditambahkan');
        }
    }

    public function update($id_user, Request $request){
      $request->validate([
         'nama_user' => 'required',
         'email' => 'required',
     ]);
     
     $rand = Str::random(8);
     $pw = bcrypt($rand);
     $mitra = User::where('id', $id_user)->first();
     $store = $mitra->update([
      'nama_user'    => $request->nama_user,
      'email'        => $request->email,
      'password'     => $pw,
      'mitra'        => 1,
     ]);
     if($store){
         $details = [
             'title'    => 'Akun Cleaning Service Universitas Ibnu Sina',
             'nama'     => $request->nama_user,
             'email'    => $request->email,
             'pass'     => $rand,
         ];
         // send email
         \Mail::to($request->email)->send(new \App\Mail\SendPassword($details));

         return redirect()->route('manajer.mitraac.index')
                          ->with('success','Data cs berhasil Dirubah');
     } else{
         return redirect()->route('manajer.mitraac.index')
                          ->with('failed','Data cs gagal Dirubah');
     }
    }

    public function destroy($id_user){
      User::where('id', $id_user)->delete();
      return redirect()->back();
    }
    // Mitra view
    public function index(){
         // waktu 
         Carbon::setLocale('id');
         $time = Carbon::now()->formatLocalized("%A, %d %B %Y");
         
        $ruang = Ruang::latest()->get();

         return view('mitraAc.dashboard', compact('time','ruang'));
    }
}
