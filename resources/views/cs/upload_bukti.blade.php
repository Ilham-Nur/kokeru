@extends('layout.cs.content')

@section('top-menu')
    <h6 class="h2 text-white d-inline-block mb-0">Ruang {{ $id_ruang }}</h6><br>
    <p class="text-dark">{{ $time }}</p>
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
          @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="alert-text">
                @foreach($errors->all() as $err)
                  <li>{{$err}}</li>
                @endforeach
              </span>
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
                <h3 class="mb-0">Upload Bukti Ruang R{{ $id_ruang }}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <form action="{{ route('cs.bukti.upload') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <input type="hidden" name="id_lap" value="{{$last[0]->id}}">
                    <input type="hidden" name="id_ruang" value="{{$id_ruang}}">
                    <p>Bukti Laporan</p>
                    @error('foto[]')
                <small class="text-red">{{ $message }}</small>
                    @enderror
                    <div class="custom-file mb-2">
                        <input type="file" class="custom-file-input" name="bukti[]" id="bukti[]" lang="en" accept="image/png, image/jpg, image/jpeg, image/svg, video/mp4, video/mpeg, video/3gp, video/mkv" multiple>
                        <label class="custom-file-label" for="bukti[]">Select file</label>
                    </div>
                    <i><small>*Pilih foto dan video sekaligus, lalu klik Upload untuk menyimpan bukti laporan.</small>
                  <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary mt-4" value="Upload">
                    <button type="reset" class="btn btn-md btn-danger mt-4">Reset</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection