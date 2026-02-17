<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajerRead
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) return redirect()->route('auth.login');

        $u = Auth::user();

        if ($u->manajer == 1) { // 1,0 dan 1,1 sama-sama lolos
            return $next($request);
        }

        return redirect()->back();
    }
}
