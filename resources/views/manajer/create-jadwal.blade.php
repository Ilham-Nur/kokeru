@extends('layout.manajer.content')

@section('top-menu')
  <a href="{{route('jadwal.create')}}">
    <button type="button" class="btn btn-sm btn-default mt-0 ml-8">Tambah Jadwal</button>
  </a>
@endsection

@section('content')
  <script>
    arr_ruang = []
    $(document).ready(function () {
      $('#user').on('change', function () {
        $('#nama_user').html($('#user').val())
      });

      $('#ruang').on('change', function () {
        if (jQuery.inArray($('#ruang').val(), arr_ruang) == -1 && arr_ruang.length < 10) {
          if ($('#ruang').val() != '') {
            arr_ruang.push($('#ruang').val())
            list = '<li id=list' + $('#ruang').val() + '>R' + $('#ruang').val() + '&nbsp;&nbsp; - &nbsp;&nbsp;<a class="text-red del" id="' + $('#ruang').val() + '" href="#"><small>Hapus</small></a></li>'
            $('#list_ruang').append(list)
            $('#hidden_list').val(arr_ruang)
            $('#hidden_count').val(arr_ruang.length)
            console.log(arr_ruang)
          }
        } else {
          if (arr_ruang.length > 10) {
            alert('Jumlah ruang untuk cs maksimal adalah 10 !')
          } else {
            alert('Anda sudah memilih ruang R' + $('#ruang').val())
          }
        }
      });

      $('#list_ruang').on('click', '.del', function () {
        val = $(this).attr("id")
        id = 'list' + val
        idl = '#' + id
        $(idl).remove()
        arr_ruang = $.grep(arr_ruang, function (value) {
          return value != val
        })
        $('#hidden_list').val(arr_ruang)
        $('#hidden_count').val(arr_ruang.length)
        console.log(arr_ruang)
      });
    });
  </script>
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
          <div class="card-header border-0">
            <h3 class="mb-0">Tambah Jadwal</h3>
          </div>
          <div class="card-body mt-0 mb-0 pt-0" style="height:480px">
            <form action="{{route('jadwal.store')}}" method="POST">
              @csrf
              <input type="hidden" name="ruangs" value="" id="hidden_list">
              <input type="hidden" name="count_ruang" value="" id="hidden_count">
              <div class="row">
                <div class="col-md-4">
                  <select class="form-control" id="user" name="user" required>
                    <option value="">Pilih CS</option>
                    @foreach($cs as $c)
                      <option value="{{$c->nama_user}}">{{$c->nama_user}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-control" id="ruang" name="ruang" required>
                    <option value="">Pilih Ruang</option>
                    @foreach($ruang as $r)
                      <option value="{{$r->id}}">{{$r->nama_ruang}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                  <div class="w-100 d-flex gap-2">

                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary w-50">

                    <a href="{{ route('manajer.jadwal.index') }}" class="btn btn-danger w-50 text-center">
                      Kembali
                    </a>

                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-12 pt-1">
                <small><i>*Pilih nama CS, kemudian pilih ruang-ruang untuk CS. Ruang yang dapat dipilih maksimal berjumlah
                    10.<br> Kemudian klik Simpan Jadwal untuk menyimpan semuanya</i></small><br>
                <br>Distribusi ruang untuk CS <b><span id="nama_user"></span></b>
                <br>
                <ol id="list_ruang">

                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection