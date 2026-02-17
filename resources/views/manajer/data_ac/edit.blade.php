@extends('layout.manajer.content')
@section('top-menu')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            Tambah Data AC
        </div>
        <div class="card-body">
            <form action="{{ route('data.ac.update', ['id_ac' => $id_ac, 'id_ruang' => $id_ruang]) }}" method="POST">
                @method('put')
                @csrf
                @include('form_data_ac.__form')
                <div class="row">
                    <div>
                        <button class="btn btn-success">Edit</button>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">
                        ← Back
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
