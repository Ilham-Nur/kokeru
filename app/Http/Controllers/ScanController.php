<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function __invoke(string $token): RedirectResponse
    {
        $ruang = Ruang::where('scan_token', $token)->firstOrFail();

        if (!Auth::check()) {
            return redirect()->guest(route('auth.login'));
        }

        $user = Auth::user();

        if ((int) $user->mitra === 1) {
            return redirect()->route('mitra.pemeliharaan.index', $ruang->id);
        }

        if ((int) $user->manajer === 1) {
            return redirect()->route('data.ac.index', $ruang->id);
        }

        return redirect()->route('cs.dashboard');
    }
}
