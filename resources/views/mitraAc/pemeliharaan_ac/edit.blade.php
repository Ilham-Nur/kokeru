@extends('layout.mitraAc.content')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Kontrol Ac Ruangan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('mitra.pemeliharaan.update', ['id_ruang' => $id_ruang, 'id_pemeliharaan'=> $id_pemeliharaan, 'id_ac' => $id_ac]) }}" method="POST">
            @method('put')
            @csrf
            @include('form_pemeliharaan_ac.__form')

            <div>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection