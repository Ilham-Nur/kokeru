<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulanList = [];
        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::create(null, $i, 1);
            $bulanList[$i] = $date->format('F');
        }
        $ruang = Ruang::get();
        $last = Ruang::select('id')->orderByDesc('id')->limit(1)->get();
        return view('manajer.ruang', ['ruang' => $ruang, 'last' => $last, 'bulanList' => $bulanList]);
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
            'nama_ruang' => 'required',
        ]);
    
        $store = Ruang::create($request->all());
        if($store){
            return redirect()->route('manajer.ruang.index')
                             ->with('success','Data ruang berhasil ditambahkan');
        } else{
            return redirect()->route('manajer.ruang.index')
                             ->with('failed','Data ruang gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function show(Ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruang $ruang)
    {
        return view('manajer.edit-ruang',compact('ruang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'nama_ruang' => 'required',
        ]);
    
        $update = $ruang->update($request->all());
        if($update){
            return redirect()->route('manajer.ruang.index')
                             ->with('success','Data ruang berhasil diperbarui');
        } else{
            return redirect()->route('manajer.ruang.index')
                             ->with('failed','Data ruang gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruang $ruang)
    {
        $delete = $ruang->delete();
        if($delete){
            return redirect()->route('manajer.ruang.index')
                             ->with('success','Data ruang berhasil dihapus');
        } else{
            return redirect()->route('manajer.ruang.index')
                             ->with('failed','Data ruang gagal dihapus');
        }
    }
}
