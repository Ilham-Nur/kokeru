@extends('layout.manajer.content')
@section('top-menu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="card-body">
        <form action="{{ route('cs.inventaris..sarana.update', ['id' => $id, 'id_ruang' => $id_ruang]) }}" method="post"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            @include('form_inventaris.__form_inventaris_sarana')
        </form>
    </div>
</div>
@endsection