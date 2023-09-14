<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileCSController extends Controller
{
    public function index(){
        $profile = User::where('id', auth()->user()->id)->get();
        return view('cs.profil', ['profile' => $profile]);
    }
}
