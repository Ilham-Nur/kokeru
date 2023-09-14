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
                  <h3 class="mb-0">Edit Profil</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            @if(Auth::user()->manajer)
            <form action="{{ route('manajer.profil') }}" method="POST">
            @else
            <form action="{{ route('update-akun') }}" method="POST">
            @endif
                @csrf
                @method('patch')
              <input type="hidden" name="id_user" value="{{ $profil->id }}">
                <div class="form-group">
                  <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" type="text" value="{{ $profil->nama_user }}" name="nama" id="nama" required>
              </div>
              <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
              <input class="form-control" type="email" value="{{ $profil->email}}" name="email" id="email" required>
            </div>
            <div class="form-group">
              <label for="password" class="form-control-label">Password lama <small class="text-muted"></small></label>
              <input class="form-control" type="password" name="password" id="password" minlength="5">
          </div>
          <div class="form-group">
            <label for="password_confirmation" class="form-control-label">Password baru</label>
            <input class="form-control" type="password" name="password_new" id="password_new">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Update" class="btn btn-primary">
          @if(Auth::user()->manajer)
          <a href="{{ route('manajer.dashboard') }}" class="btn btn-secondary">Cancel</a>
          @else
          <a href="{{ route('akun') }}" class="btn btn-secondary">Cancel</a>
          @endif
      </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
