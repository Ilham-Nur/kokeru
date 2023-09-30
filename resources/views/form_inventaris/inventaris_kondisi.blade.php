<div class="card">
    <div class="card-header">Data Kondisi Inventaris Bulan {{ $bulan }}
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="ruangan" class="form-label">Ruangan</label>
                    <input type="text" class="form-control" id="ruangan" aria-describedby="ruangan"
                        value="{{ $ruang->nama_ruang }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="pj_ruangan" class="form-label">PJ Ruangan</label>
                    <input type="text" class="form-control" id="pj_ruangan" value="{{ $ruang->pj_ruang }}" readonly>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="tahun" class="form-label">Bulan</label>
                    <input type="text" class="form-control" id="tahun" value="{{ $bulan }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="text" class="form-control" id="tahun" value="{{ $tahun }}" disabled>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-header">Tabel Data Inventaris</div>
    <div class="card-body">
        <div>
            <table class="w-100 table table-bordered table-responsive-xl" id="data">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <td>Sarana</td>
                        <td>Bulan</td>
                        <td>kuantiti</td>
                        <td>kondisi</td>
                        <td>dipinjam</td>
                        <td>mutasi</td>
                        <td>user</td>
                        <td>sign</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ( $saranas as $item)
                    {{-- {{ $item->inventarisKondisi->bulan === $bulanAngka }} --}}
                    @php
                    $kondisi = $item->inventarisKondisis->first();
                    @endphp
                    <tr class="text-center">
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->nama_sarana }}</td>
                        <td>
                            {{ $bulan }}
                        </td>
                        <td>
                            @isset($kondisi)
                            <i class="fas fa-{{ ($kondisi->kuantiti ) ? 'check' : 'times' }}"></i>
                            @endisset
                        </td>

                        <td>
                            @isset($kondisi)
                            <i class="fas fa-{{ ($kondisi->kondisi) ? 'check' : 'times' }}"></i>
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            <i class="fas fa-{{ ($kondisi->dipinjam) ? 'check' : 'times' }}"></i>
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            <i class="fas fa-{{ ($kondisi->mutasi) ? 'check' : 'times' }}"></i>
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            <i class="fas fa-{{ ($kondisi->user) ? 'check' : 'times' }}"></i>
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            <i class="fas fa-{{ ($kondisi->sign) ? 'check' : 'times' }}"></i>
                            @endisset
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#kontrol{{ $item->id }}">
                                Kontrol
                            </button>
                        </td>
                    </tr>
                    {{-- @endforeach
                    @foreach ( $sarana as $item) --}}
                    <!-- Modal Kontrol-->
                    <div class="modal fade" id="kontrol{{ $item->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Form Kontrol Data Sarana</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- {{ dd(Auth::user()->manajer) }} --}}
                                    @if (Auth::user()->manajer === 1 )
                                    <form
                                        action="{{ route('manajer.inventaris.kondisi.store', ['id_sarana' => $item->id, 'bulan' => $bulan]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @else
                                        <form
                                            action="{{ route('cs.inventaris.kondisi.store', ['id_sarana' => $item->id, 'bulan' => $bulan]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            {{-- {{ $item->inventarisKondisi === $bulanAngka }} --}}
                                            <div class="form-group row">
                                                <label for="id_sarana"
                                                    class="col-sm-4 font-weight-bold col-form-label">Nama
                                                    Sarana</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="id_sarana" class="form-control border-none"
                                                        id="id_sarana" value="{{ $item->nama_sarana }}" readonly>
                                                </div>
                                            </div>
                                            <fieldset class="form-group row">
                                                <legend
                                                    class="col-form-label col-sm-4 font-weight-bold float-sm-left pt-0">
                                                    Kuantiti
                                                </legend>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        {{-- {{ dd( $kondisi->kuantiti) }} --}}

                                                        <input class="form-check-input" type="radio" name="kuantiti"
                                                            id="kuantiti_ya{{ $item->id }}" value="1"
                                                            @isset($kondisi->kuantiti)
                                                        {{($kondisi->kuantiti === 1) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label{{ $item->id }}"
                                                            for="kuantiti_ya{{ $item->id }}">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kuantiti"
                                                            id="kuantiti_tidak{{ $item->id }}" value="0"
                                                            @isset($kondisi) {{ ($kondisi->kuantiti === 0) ? 'checked' :
                                                        '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label"
                                                            for="kuantiti_tidak{{ $item->id }}">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset class="form-group row">
                                                <legend
                                                    class="col-form-label col-sm-4 font-weight-bold float-sm-left pt-0">
                                                    Kondisi
                                                </legend>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kondisi"
                                                            id="kondisi_ya{{ $item->id }}" value="1" @isset($kondisi) {{
                                                            ($kondisi->kondisi === 1) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label" for="kondisi_ya{{ $item->id }}">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kondisi"
                                                            id="kondisi_tidak{{ $item->id }}" value="0" @isset($kondisi)
                                                            {{ ($kondisi->kondisi === 0) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label"
                                                            for="kondisi_tidak{{ $item->id }}">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group row">
                                                <legend
                                                    class="col-form-label col-sm-4 font-weight-bold float-sm-left pt-0">
                                                    Dipinjam
                                                </legend>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="dipinjam"
                                                            id="dipinjam_ya{{ $item->id }}" value="1" @isset($kondisi)
                                                            {{ ($kondisi->dipinjam === 1) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label"
                                                            for="dipinjam_ya{{ $item->id }}">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="dipinjam"
                                                            id="dipinjam_tidak{{ $item->id }}" value="0"
                                                            @isset($kondisi) {{ ($kondisi->dipinjam === 0) ? 'checked' :
                                                        '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label"
                                                            for="dipinjam_tidak{{ $item->id }}">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group row">
                                                <legend
                                                    class="col-form-label col-sm-4 font-weight-bold float-sm-left pt-0">
                                                    Mutasi
                                                </legend>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="mutasi"
                                                            id="mutasi_ya{{ $item->id }}" value="1" @isset($kondisi) {{
                                                            ($kondisi->mutasi === 1) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label" for="mutasi_ya{{ $item->id }}">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="mutasi"
                                                            id="mutasi_tidak{{ $item->id }}" value="0" @isset($kondisi)
                                                            {{ ($kondisi->mutasi === 0) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label"
                                                            for="mutasi_tidak{{ $item->id }}">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group row">
                                                <legend
                                                    class="col-form-label col-sm-4 font-weight-bold float-sm-left pt-0">
                                                    User</legend>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="user"
                                                            id="user_ya{{ $item->id }}" value="1" @isset($kondisi) {{
                                                            ($kondisi->user === 1) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label" for="user_ya{{ $item->id }}">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="user"
                                                            id="user_tidak{{ $item->id }}" value="0" @isset($kondisi) {{
                                                            ($kondisi->user === 0) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label" for="user_tidak{{ $item->id }}">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group row">
                                                <legend
                                                    class="col-form-label col-sm-4 font-weight-bold float-sm-left pt-0">
                                                    Sign</legend>
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sign"
                                                            id="sign_ya{{ $item->id }}" value="1" @isset($kondisi) {{
                                                            ($kondisi->sign === 1) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label" for="sign_ya{{ $item->id }}">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sign"
                                                            id="sign_tidak{{ $item->id }}" value="0" @isset($kondisi) {{
                                                            ($kondisi->sign === 0) ? 'checked' : '' }}
                                                        @endisset
                                                        >
                                                        <label class="form-check-label" for="sign_tidak{{ $item->id }}">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="border-top border-bold border-dark mb-2"></div>
                                            <div class="d-flex justify-content-center ">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>