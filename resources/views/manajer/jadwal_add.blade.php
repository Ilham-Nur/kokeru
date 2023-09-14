@extends('layout.manajer.content')

@section('top-menu')
    <h6 class="h2 text-white d-inline-block mb-0">{{ $time }}</h6>
@endsection

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
          <div class="card pb-5">
            <!-- Card header -->
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Tambah Jadwal</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form action="{{ route('manajer.jadwal.add') }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="tanggal" class="form-control-label">Tanggal <small class="text-red">* berlaku selama 1 bulan ke depan</small></label>
                          <input class="form-control" type="date" id="tanggal" value="<?= date('Y-m-d') ?>" name="tanggal" readonly>
                      </div>
                
                <div class="form-group">
                    <label for="nama_ruang" class="form-control-label">Nama Ruang</label>
                    <select name="nama_ruang" id="nama_ruang" class="form-control">
                        @foreach ($ruang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_cs" class="form-control-label">Nama CS</label>
                    <select name="nama_cs" id="nama_cs" class="form-control">
                        @foreach ($cs as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_user }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                    <a href="{{ route('manajer.jadwal') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection