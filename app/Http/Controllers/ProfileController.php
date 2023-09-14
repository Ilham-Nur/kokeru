<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        if(auth()->user()->manajer){
            $manajer = Auth::user();
            return view('manajer.profil', ['profil' => $manajer]);
        } else{
            $cs = Auth::user();
            return view('manajer.profil', ['profil' => $cs]);
        }
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $id = auth()->user()->id;

        if(isset($request->password)){
            if(!isset($request->password_new)){
                if(auth()->user()->manajer){
                    return redirect()->route('manajer.profil')->with('failed', 'Anda belum memasukkan password baru');
                } else{
                    return redirect()->route('akun')->with('failed', 'Anda belum memasukkan password baru');
                }
            }
            $pass = Hash::check($request->password, auth()->user()->password);
            if ($pass){
                $store = User::where('id', $id)
                ->update([
                    'nama_user' => $request->nama,
                    'email' => $request->email,
                    'password' => bcrypt($request->password_new)
                ]);
            } else {
                if(auth()->user()->manajer){
                    return redirect()->route('manajer.profil')->with('failed', 'Password tidak sama!');
                } else{
                    return redirect()->route('akun')->with('failed', 'Password tidak sama!');
                }
            }
        } else{
            $store = User::where('id', $id)
                ->update([
                    'nama_user' => $request->nama,
                    'email' => $request->email,
                ]);
        }

        if ($store){
            if(auth()->user()->manajer){
                return redirect()->route('manajer.profil')->with('success', 'Data Anda berhasil diperbarui');
            } else{
                return redirect()->route('akun')->with('success', 'Data Anda berhasil diperbarui');
            }
        } else {
            if(auth()->user()->manajer){
                return redirect()->route('manajer.profil')->with('failed', 'Data Anda gagal diperbarui');
            } else{
                return redirect()->route('akun')->with('failed', 'Data Anda gagal diperbarui');
            }
        }
    }
}
