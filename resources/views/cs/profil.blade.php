@extends('layout.cs.content')

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
                  <h3 class="mb-0">Edit Profil</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form action="{{ route('cs.profil') }}" method="POST">
                @csrf
                @method('patch')
              <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group">
                  <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" type="text" value="{{ $nama }}" name="nama" id="nama" required>
              </div>
              <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
              <input class="form-control" type="email" value="{{ $email}}" name="email" id="email" required>
            </div>
            <div class="form-group">
              <label for="password" class="form-control-label">Password <small class="text-muted"></small></label>
              <input class="form-control" type="password" name="password" id="password" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="password_confirmation" class="form-control-label">Re-type Password</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Update" class="btn btn-primary">
          <a href="{{ route('cs.profil') }}" class="btn btn-secondary">Cancel</a>
      </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection