@extends('layout.manajer.content')
@section('top-menu')
@endsection

@section('content')
@php $isReadOnly = auth()->user()->manajer == 1 && auth()->user()->mitra == 1; @endphp

    <div class="card">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Tabel Data AC</h3>
            
            {{-- Area Tombol (Kembali & Tambah Data) --}}
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>

                @if(!$isReadOnly)
                <a href="{{ route('data.ac.create', $id_ruang) }}" class="btn btn-primary ml-2">
                    Tambah Data
                </a>
                @endif
            </div>
        </div>
        
        <div class="card-body mt-0 pt-0">
            <div class="table-responsive">
                <table class="table table-bordered table-flush" id="data">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Ruang</th>
                            <th>No Seri</th>
                            <th>Jenis</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Kapasitas</th>
                            {{-- Sembunyikan kolom Aksi di header jika ReadOnly --}}
                            @if(!$isReadOnly)
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_ac as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ruang->nama_ruang }}</td>
                                <td>{{ $item->no_seri }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->kapasitas }}</td>
                                
                                {{-- Sembunyikan tombol Edit & kolomnya jika ReadOnly --}}
                                @if(!$isReadOnly)
                                <td>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('data.ac.edit', ['id_ac' => $item->id, 'id_ruang' => $id_ruang]) }}">
                                        Edit
                                    </a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection