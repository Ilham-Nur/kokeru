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
        // validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // login attempt
        if (auth()->attempt($request->only('email', 'password'), $request->remember)) {

            $user = auth()->user();

            if ($user->manajer == 1 && $user->mitra == 1) {
                // manajer read only
                return redirect()->route('manajerread.dashboard');

            } elseif ($user->manajer == 1) {
                // manajer full akses
                return redirect()->route('manajer.dashboard');

            } elseif ($user->mitra == 1) {
                // mitra
                return redirect()->route('mitra.dashboard');
            }

            // default role
            return redirect()->route('cs.dashboard');
        }

        return back()->with('status', 'Anda belum mempunyai akun');
    }
}
