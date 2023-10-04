@extends('layout.manajer.content')
@section('top-menu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-body">
            <form action="{{ route('manager.inventaris..sarana.update', ['id' => $id, 'id_ruang' => $id_ruang]) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                @include('form_inventaris.__form_inventaris_sarana')
            </form>
        </div>
    </div>
</div>
@endsection