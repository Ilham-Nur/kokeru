<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->manajer) {
            $manajer = Auth::user();
            return view('manajer.profil', ['profil' => $manajer]);
        } else {
            $cs = Auth::user();
            return view('manajer.profil', ['profil' => $cs]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email',
            'password'     => 'nullable',
            'password_new' => 'nullable|min:5|confirmed|required_with:password',
        ]);

        $user = auth()->user();

        // Update basic info dulu
        $data = [
            'nama_user' => $request->nama,
            'email'     => $request->email,
        ];

        // Kalau user memang berniat ganti password
        if ($request->filled('password')) {

            // Cek password lama benar
            if (!Hash::check($request->password, $user->password)) {
                return $user->manajer
                    ? redirect()->route('manajer.profil')->with('failed', 'Password lama tidak sama!')
                    : redirect()->route('akun')->with('failed', 'Password lama tidak sama!');
            }

            // Set password baru
            $data['password'] = Hash::make($request->password_new);
        }

        $store = User::where('id', $user->id)->update($data);

        if ($store) {
            return $user->manajer
                ? redirect()->route('manajer.profil')->with('success', 'Data Anda berhasil diperbarui')
                : redirect()->route('akun')->with('success', 'Data Anda berhasil diperbarui');
        }

        return $user->manajer
            ? redirect()->route('manajer.profil')->with('failed', 'Data Anda gagal diperbarui')
            : redirect()->route('akun')->with('failed', 'Data Anda gagal diperbarui');
    }
}
