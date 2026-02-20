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
            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif
            <form action="{{ route('cs.bukti.upload') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @isset($last)
                <input type="hidden" name="id_ruang" value="{{$id_ruang}}">
              @else
                <input type="hidden" name="id_lap" value="{{$last[0]->id}}">
                <input type="hidden" name="id_ruang" value="{{$id_ruang}}">
              @endisset
              <p>Bukti Laporan</p>
              @error('foto[]')
                <small class="text-red">{{ $message }}</small>
              @enderror
              {{-- <div class="custom-file mb-2">
                <input type="file" class="custom-file-input" name="bukti[]" id="bukti[]" lang="en"
                  accept="image/png, image/jpg, image/jpeg, image/svg, video/mp4, video/mpeg, video/3gp, video/mkv"
                  multiple>
                <label class="custom-file-label" for="bukti[]">Select file</label>
              </div> --}}

              <div class="upload-multiple">
                <div class="input-group hdtuto control-group lst increment">
                  <input type="file" name="bukti[]" class="myfrm form-control" id="bukti[]" lang="en"
                    accept="image/png, image/jpg, image/jpeg, image/svg, video/mp4, video/mpeg, video/3gp, video/mkv">
                  <div class="input-group-btn">
                    <button class="btn btn-success" type="button"><i
                        class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                  </div>
                </div>
                <div class="clone hide">
                  <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                    <input type="file" class="custom-file-input myfrm form-control" name="bukti[]" id="bukti[]" lang="en"
                      accept="image/png, image/jpg, image/jpeg, image/svg, video/mp4, video/mpeg, video/3gp, video/mkv">

                    <div class="input-group-btn">
                      <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i>
                        Remove</button>
                    </div>
                  </div>
                  <i><small>*Pilih foto dan video sekaligus, lalu klik Upload untuk menyimpan bukti laporan.</small>
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="deskripsi">Deskripsi Kerusakan <small class="text-muted">(opsional)</small></label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
                  placeholder="Contoh: AC tidak dingin, kaca jendela retak, dll...">{{ old('deskripsi') }}</textarea>
              </div>
              <input type="submit" name="submit" class="btn btn-primary mt-4" value="Upload">
              <button type="reset" class="btn btn-md btn-danger mt-4">Reset</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function () {
      $(".btn-success").click(function () {
        var lsthmtl = $(".clone").html();
        $(".increment").after(lsthmtl);
      });
      $("body").on("click", ".btn-danger", function () {
        $(this).parents(".hdtuto").remove();
      });
    });
  </script>
@endsection