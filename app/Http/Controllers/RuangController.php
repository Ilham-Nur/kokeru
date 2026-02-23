<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
            'pj_ruang' => 'required',
        ]);

        $ruang = Ruang::create($request->only(['id', 'nama_ruang', 'pj_ruang']));

        $this->ensureQr($ruang);

        if ($ruang) {
            return redirect()->route('manajer.ruang.index')
                ->with('success', 'Data ruang berhasil ditambahkan');
        } else {
            return redirect()->route('manajer.ruang.index')
                ->with('failed', 'Data ruang gagal ditambahkan');
        }
    }

    private function ensureQr(Ruang $ruang): void
    {
        if (!$ruang->scan_token) {
            $ruang->scan_token = Str::random(32);
        }

        $url  = url('/scan/' . $ruang->scan_token);
        $path = "qrcode/ruang-{$ruang->id}.svg";

        $needGenerate = !$ruang->qr_path
            || !Storage::disk('public')->exists($ruang->qr_path)
            || $ruang->qr_url !== $url;

        if ($needGenerate) {
            $svg = QrCode::format('svg')->size(260)->generate($url);
            Storage::disk('public')->put($path, $svg);

            $ruang->qr_path = $path;
            $ruang->qr_url  = $url;
        }

        $ruang->save();
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
        return view('manajer.edit-ruang', compact('ruang'));
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
            'pj_ruang'   => 'required',
        ]);

        $update = $ruang->update($request->all());
        
        if (!$ruang->scan_token || !$ruang->qr_path) {
            $this->ensureQr($ruang);
        }
        if ($update) {
            return redirect()->route('manajer.ruang.index')
                ->with('success', 'Data ruang berhasil diperbarui');
        } else {
            return redirect()->route('manajer.ruang.index')
                ->with('failed', 'Data ruang gagal diperbarui');
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
        if ($delete) {
            return redirect()->route('manajer.ruang.index')
                ->with('success', 'Data ruang berhasil dihapus');
        } else {
            return redirect()->route('manajer.ruang.index')
                ->with('failed', 'Data ruang gagal dihapus');
        }
    }
}
