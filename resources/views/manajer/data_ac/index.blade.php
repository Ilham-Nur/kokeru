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
            <table class="table table-bordered table-responsive-sm" id="data">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Ruang</th>
                        <th scope="col">No Seri</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Type</th>
                        <th scope="col">Kapasitas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        @foreach ($data_ac as $item)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ruang->nama_ruang }}</td>
                            <td>{{ $item->no_seri }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->merk }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->kapasitas }}</td>
                            <td>
                                <a type="button" class="btn btn-warning btn-sm" href="{{ route('data.ac.edit', ['id_ac' => $item->id, 'id_ruang' => $id_ruang] ) }}">Edit</a>
                               
                            </td>
                        @endforeach
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection