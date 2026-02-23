<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            $user = auth()->user();

            if ($user->manajer == 1 && $user->mitra == 1) {
                return redirect()->intended(route('manajerread.dashboard'));
            }

            if ($user->manajer == 1) {
                return redirect()->intended(route('manajer.dashboard'));
            }

            if ($user->mitra == 1) {
                return redirect()->intended(route('mitra.dashboard'));
            }

            return redirect()->intended(route('cs.dashboard'));
        }

        return back()->with('status', 'Anda belum mempunyai akun');
    }
}
