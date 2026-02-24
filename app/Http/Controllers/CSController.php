<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class CSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cs = User::where('manajer', '=', 0)->get();
        $last = User::select('id')->orderByDesc('id')->limit(1)->latest()->get();

        // --- LOGIKA JIKA TOMBOL PRINT DIKLIK ---
        if ($request->has('print') && $request->print == 'pdf') {
            $pdf = PDF::loadView('manajer.cs-pdf', compact('cs'));
            return $pdf->stream('Data_Cleaning_Service.pdf', array('Attachment' => false));
        }

        return view('manajer.cs', ['cs' => $cs, 'last' => $last]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama_user' => 'required',
            'email' => 'required',
        ]);

        $rand = Str::random(8);
        $pw = bcrypt($rand);
        $store = DB::insert('insert into users (id,nama_user,email,password,manajer) values (?,?,?,?,?)', [$request->id, $request->nama_user, $request->email, $pw, 0]);
        if ($store) {
            $details = [
                'title' => 'Akun Cleaning Service Kokeru',
                'nama' => $request->nama_user,
                'email' => $request->email,
                'pass' => $rand,
            ];
            // send email
            \Mail::to($request->email)->send(new \App\Mail\SendPassword($details));

            return redirect()->route('manajer.cs.index')
                ->with('success', 'Data cs berhasil ditambahkan');
        } else {
            return redirect()->route('manajer.cs.index')
                ->with('failed', 'Data cs gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cs $cs
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cs = Auth::user();
        return view('cs.profil', ['cs' => $cs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cs  $cs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cs = User::Find($id);
        return view('manajer.edit-cs', compact('cs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cs  $cs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required',
        ]);

        $update = User::where('id', $id)
            ->update([
                'nama_user' => $request->nama_user,
                'email' => $request->email
            ]);
        if ($update) {
            return redirect()->route('manajer.cs.index')
                ->with('success', 'Data cs berhasil diperbarui');
        } else {
            return redirect()->route('manajer.cs.index')
                ->with('failed', 'Data cs gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cs  $cs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('manajer.cs.index')
                ->with('success', 'Data cs berhasil dihapus');
        } else {
            return redirect()->route('manajer.cs.index')
                ->with('failed', 'Data cs gagal dihapus');
        }
    }
}
