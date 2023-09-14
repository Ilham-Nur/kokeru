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
                  <h3 class="mb-0">Edit Jadwal </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('jadwal.update',$jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-control-label">Nama CS</label>
                    <select class="form-control" name="user" required>
                      @foreach($cs as $c)
                        <option value="{{$c->id}}" <?=($c->id==$jadwal->id_user)?'selected':''?>>{{$c->nama_user}}</option>
                      @endforeach
                    </select><br>
                    <label class="form-control-label">Nama Ruang</label>
                    <select class="form-control" name="ruang" required>
                      <option value="{{$jadwal->id_ruang}}">R{{$jadwal->id_ruang}}</option>
                      @foreach($ruang as $r)
                        <option value="{{$r->id}}">{{$r->nama_ruang}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    <a href="{{ route('manajer.jadwal.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection