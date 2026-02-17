@extends('layout.manajer.content')
@section('top-menu')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Tabel Data AC
            <div class="float-right">
                <a href="{{ route('data.ac.create', $id_ruang) }}" class="btn btn-primary">
                    Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Ruang</th>
                            <th>No Seri</th>
                            <th>Jenis</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
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
                                <td>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('data.ac.edit', ['id_ac' => $item->id, 'id_ruang' => $id_ruang]) }}">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection