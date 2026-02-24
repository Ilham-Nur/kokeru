@extends('layout.manajer.content')

@section('top-menu')
@php $isReadOnly = auth()->user()->manajer == 1 && auth()->user()->mitra == 1; @endphp

{{-- Tombol Tambah Hanya Muncul Jika Bukan Mitra AC --}}
@if(!$isReadOnly)
    <button type="button" class="btn btn-sm btn-default mt-0 ml-8" data-toggle="modal" data-target="#modal-form">Tambah
        Ruang</button>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" method="POST" action="{{ route('ruang.store') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        @foreach ($last as $l)
                                            <?php $id = $l->id + 1; ?>
                                            <input class="form-control" type="text" name="id"
                                                value="{{ $id }}" style="padding-left: 5pt" readonly>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                                        </div>
                                        <input class="form-control" name="nama_ruang" placeholder="Nama Ruang"
                                            type="text" required minlength="3" maxlength="5">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                                        </div>
                                        <input class="form-control" name="pj_ruang" placeholder="PJ Ruang" type="text"
                                            required minlength="3" maxlength="5">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" value="Tambah"></input>
                                    <button type="reset" class="btn btn-md btn-danger">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ session('failed') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card pb-5">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Data Ruang</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="data">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col" class="sort" data-sort="name">ID <i class="fas fa-sort"></i></th>
                                    <th scope="col" class="sort">Nama Ruang <i class="fas fa-sort"></i></th>
                                    <th scope="col" class="sort">Inventaris Sarana <i class="fas fa-sort"></i></th>
                                    <th scope="col" class="sort">Data AC <i class="fas fa-sort"></i></th>
                                    {{-- KOLOM AKSI DIBUKA UNTUK SEMUA ROLE (KARENA ADA TOMBOL BARCODE) --}}
                                    <th scope="col" class="sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($ruang as $r)
                                    <tr class="text-center">
                                        <th scope="row">{{ $r->id }}</th>
                                        <td>{{ $r->nama_ruang }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#inventaris{{ $r->id }}">
                                                <i class="fas fa-wrench"></i>
                                            </button>
                                            <a class="btn btn-sm btn-secondary"
                                                href="{{ route('inventaris.sarana', $r->id) }}"><i
                                                    class="fas fas fa-plus"></i></a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('data.ac.index', $r->id) }}"><i
                                                    class="fas fa-wrench"></i></a>
                                        </td>
                                        <td>
                                            @if(!$isReadOnly)
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('ruang.edit', $r->id) }}">Edit</a>&nbsp;&nbsp;
                                            @endif
                                            
                                            {{-- Barcode selalu muncul untuk semua --}}
                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#barcode{{ $r->id }}">
                                                Barcode
                                            </button>
                                            
                                            @if(!$isReadOnly)
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                                                data-target="#konfirmDelete{{ $r->id }}">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- SEMUA MODAL DIPINDAHKAN KE BAWAH AGAR DATATABLES BERJALAN LANCAR --}}
    @foreach ($ruang as $r)
        {{-- Modal Delete --}}
        @if(!$isReadOnly)
        <div class="modal fade" id="konfirmDelete{{ $r->id }}" tabindex="-1"
            role="dialog" aria-labelledby="{{ $r->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class=" text-default mb-0">
                                    Anda yakin ingin menghapus data ruang {{ $r->nama_ruang }} ?
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('ruang.destroy', $r->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="button" class="btn btn-secondary"
                            data-dismiss="modal">Batal</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="modal fade" id="inventaris{{ $r->id }}" data-backdrop="static"
            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Data Inventaris</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div>
                                <h4>Ruangan : <span
                                        class="text-muted">{{ $r->nama_ruang }}</span></h4>
                                <h4>Pj Ruangan : <span class="text-muted">AMIN</span></h4>
                                <h4>Tahun : <span class="text-muted">2024</span></h4>
                            </div>

                            <div class="my-4">
                                <h4>Bulan</h4>
                                <div class="row">
                                    <div class="row">
                                        @foreach ($bulanList as $bulan)
                                            @php
                                                $bulanSingkat = substr($bulan, 0, 3); // Mengambil tiga karakter pertama dari nama bulan
                                            @endphp
                                            <div class="col-md-4">
                                                <a href="{{ route('inventaris.bulan', ['bulan' => $bulan, 'id_ruang' => $r->id]) }}"
                                                    class="btn btn-success my-2 w-100">{{ $bulanSingkat }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Barcode --}}
        <div class="modal fade" id="barcode{{ $r->id }}" tabindex="-1"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">QR Ruangan: {{ $r->nama_ruang }}</h5>
                        <button type="button" class="close"
                            data-dismiss="modal"><span>&times;</span></button>
                    </div>

                    <div class="modal-body text-center">
                        @php $url = route('scan.token', $r->id); @endphp

                        <div id="printArea{{ $r->id }}">
                            <div style="font-weight:600; margin-bottom:8px;">
                                {{ $r->nama_ruang }}</div>
                            {!! QrCode::size(180)->generate($url) !!}
                            {{-- <div class="mt-2 small text-muted" style="word-break: break-all;">
                                {{ $url }}</div> --}}
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-primary btn-sm"
                                onclick="printArea('printArea{{ $r->id }}')">
                                Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection