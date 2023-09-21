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
        <form action="{{ route('cs.inventaris..sarana.store', $id_ruang) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @include('form_inventaris.__form_inventaris_sarana')
        </form>
    </div>
</div>
</div>
@endsection