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
                            {{ $kondisi->kuantiti }}
                            @endisset
                        </td>

                        <td>
                            @isset($kondisi)
                            {{ $kondisi->kondisi }}
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            {{ $kondisi->dipinjam }}
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            {{ $kondisi->mutasi }}
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            {{ $kondisi->user }}
                            @endisset
                        </td>
                        <td>
                            @isset($kondisi)
                            {{ $kondisi->sign }}
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
                                            <div class="form-group row">
                                                <label class="col-sm-4 font-weight-bold col-form-label">
                                                    Kuantiti
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="kuantiti" min="1" max="20"
                                                        class="form-control"
                                                        value="{{ isset($kondisi) ? $kondisi->kuantiti : '' }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 font-weight-bold col-form-label">Kondisi</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="kondisi" min="1" max="20" class="form-control"
                                                        value="{{ isset($kondisi) ? $kondisi->kondisi : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 font-weight-bold col-form-label">Dipinjam</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="dipinjam" min="1" max="20" class="form-control"
                                                        value="{{ isset($kondisi) ? $kondisi->dipinjam : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 font-weight-bold col-form-label">Mutasi</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="mutasi" min="1" max="20" class="form-control"
                                                        value="{{ isset($kondisi) ? $kondisi->mutasi : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 font-weight-bold col-form-label">User</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="user" min="1" max="20" class="form-control"
                                                        value="{{ isset($kondisi) ? $kondisi->user : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 font-weight-bold col-form-label">Sign</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="sign" min="1" max="20" class="form-control"
                                                        value="{{ isset($kondisi) ? $kondisi->sign : '' }}" required>
                                                </div>
                                            </div>
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