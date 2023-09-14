@extends('layout.manajer.content')

@section('content')
<!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <span class="alert-text">{{ session('success') }}</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if(session('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="alert-text">{{ session('failed') }}</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> Terjadi kesalahan<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <div class="card pb-5">
            <!-- Card header -->
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit Data CS </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{route('cs.update', $cs->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">ID</label>
                    <input class="form-control" type="text" value="{{$cs->id}}" name="id" readonly>
                </div>
                <div class="form-group">
                    <label for="example-search-input" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" value="{{$cs->nama_user}}" name="nama_user" required minlength="5" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="example-search-input" class="form-control-label">Email</label>
                    <input class="form-control" type="email" value="{{$cs->email}}" name="email" required minlength="15" maxlength="50">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    <a href="{{ route('manajer.cs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection