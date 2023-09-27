@extends('layout.mitraAc.content')

@section('top-menu')
  {{-- <h6 class="h2 text-white d-inline-block mb-0">{{ $time }}</h6> --}}
  <div class="header bg-success pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">{{date('d F, Y')}}</h6>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a class="" title="Previous" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="" title="Next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<!-- bersih -->
<div class="row">
      @foreach($ruang as $r)
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
                  <a href="">
                  <button class="btn btn-sm btn-icon btn-neutral">
                    <span class="btn-inner--icon"><i class="ni ni-camera-compact"></i></span>
                    <span class="btn-inner--text">Kontrol</span>
                  </button>
                </a>
                </p>
              </div>
            </div>
          </div>
          
      @endforeach
    </div>
</div>

@endsection
