@extends('layout.cs.content')

@section('top-menu')
  <h6 class="h2 text-white d-inline-block mb-0">{{ $time }}</h6>
@endsection

@section('content')
<!-- bersih -->
<div class="row">
      @foreach($laporan as $r)
      {{-- {{ dd($r) }} --}}
          @if(isset($r->id_jadwal))
          <!-- bersih -->
          <div class="col-xl-2 col-md-3 col-sm-3 col-xs-6 pb-0">
            <div class="card card-stats pb-0">
              <div class="card-img-top text-center mb-1 mt-1">
                <span class="card-title text-uppercase text-default" style="font-size: 15pt; font-weight: bold">{{$r->nama_ruang}}</span><br>
              </div>
              <!-- Card body -->
              <div class="card-body bg-gradient-green pb-0">
                <div class="row">
                  <div class="col text-center mb-4">
                    <span class="font-weight-bold  text-white">BERSIH</span><br>
                  </div>
                </div>
                <p class="mt-1 mb-0 text-center pd-0">
                  <button class="btn btn-sm btn-icon btn-neutral" data-toggle="modal" data-target="#modalImg{{$r->id_ruang}}">
                    <span class="btn-inner--icon"><i class="ni ni-camera-compact"></i></span>
                    <span class="btn-inner--text">Bukti</span>
                  </button>
                  <!-- Modal -->
                  <div class="pb-0 pt-0 modal fade mb-0" id="modalImg{{$r->id_ruang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Bukti Kebersihan dan Kerapihan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container-fluid">
                            <div class="row">
                              @foreach($bukti as $b)
                              @if($b->id_laporan == $r->id)
                              <div class="col-md-4 text-center">
                                <?php $ekst = substr($b->nama_file, -3)?>
                                @if($ekst=='mp4'||$ekst=='mkv'||$ekst=='avi'||$ekst=='mpg'||$ekst=='mov'||$ekst=='3gp')
                                  <video width="320px" height="180px" controls>
                                    <source src="{{asset('uploads/'.$b->nama_file)}}" type="video/{{$ekst}}">
                                  </video>
                                @else
                                  <a href="{{asset('uploads/'.$b->nama_file)}}" target="_blank">
                                    <span class='zoom' id='img{{$b->id}}'>
                                      <img src="{{asset('uploads/'.$b->nama_file)}}" height="180px">
                                    </span>
                                  </a>
                                  <script>
                                    $(document).ready(function() {
                                        $('#img{{$b->id}}').zoom();
                                    } );
                                  </script>
                                   
                                @endif
                              </div>
                              @endif
                              @endforeach
                              <div class="mt-2">
                                      <div class="card shadow-sm">
                                          <div class="card-body p-2">
                                              <small class="text-muted d-block mb-1">
                                                  <i class="fas fa-align-left"></i> Deskripsi
                                              </small>
                                              <p class="mb-0" style="font-size:14px;">
                                                  {{ $b->deskripsi ?? '-' }}
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                            </div> 
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </p>
              </div>
            </div>
          </div>
          @else
          <!-- belum bersih -->
          <div class="col-xl-2 col-md-3 col-sm-3 col-xs-6 pb-0">
            <div class="card card-stats shadow pb-0">
              <div class="card-img-top text-center mb-1 mt-1">
                <span class="card-title text-uppercase text-default" style="font-size: 15pt; font-weight: bold">{{$r->nama_ruang}}</span><br>
              </div>
              <!-- Card body -->
              <div class="card-body bg-gradient-red">
                <div class="row">
                  <div class="col text-center">
                    <span class="font-weight-bold mb-0 text-white">BELUM BERSIH</span><br>

                  </div>
                </div>
                <p class="mt-1 mb-0 text-center">
                  <a href="{{ route('cs.bukti', $r->id_ruang, $r->id) }}">
                  <button class="btn btn-sm btn-icon btn-neutral">
                    <span class="btn-inner--icon"><i class="ni ni-camera-compact"></i></span>
                    <span class="btn-inner--text">Upload</span>
                  </button>
                </a>
                </p>
              </div>
            </div>
          </div>
          @endif
      @endforeach
    </div>

{{-- 

  <!-- belum bersih -->
  <div class="col-xl-2 col-md-3 col-sm-3 col-xs-6">
    <div class="card card-stats shadow">
      <div class="card-img-top text-center mb-1 mt-1">
        <span class="card-title text-uppercase text-default" style="font-size: 20pt; font-weight: bold">R01</span><br>
      </div>
      <!-- Card body -->
      <div class="card-body bg-gradient-red">
        <div class="row">
          <div class="col text-center">
            <span class="h2 font-weight-bold mb-0 text-white">BELUM <br> BERSIH</span>
          </div>
        </div>
        <p class="mt-1 mb-1 text-center"></p>
      </div>
    </div>
  </div>
</div> --}}
</div>

@endsection
