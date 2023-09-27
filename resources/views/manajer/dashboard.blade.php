@extends('layout.manajer.content')

@section('content')
    <!-- Page content -->
    <div class="row">
        <div class="col-lg-6 col-7 mb-3">
            <h6 class="h2 text-white d-inline-block mb-0">{{ date('d F, Y') }}</h6>
        </div>
        <div class="col-lg-6 col-5 text-right mb-3">
            <a class="" title="Previous" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="" title="Next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0"> Customer Service</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $user }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                <i class="ni ni-single-02"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Semua Ruang</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $ruang }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                <i class="ni ni-building"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Ruang Bersih</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $bersih }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-check-bold"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Ruang Kotor</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $kotor }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="row">
                <div id="carouselExampleIndicators" class="carousel slide col-xl-12">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <?php $sum = ceil($count / 18); ?>
                        @for ($i = 1; $i < $sum; $i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner pb-5">
                        <?php $i = 1; ?>
                        @foreach ($laporan as $r)
                            @if ($i % 18 == 1)
                                <div class="carousel-item <?= $i == 1 ? 'active' : '' ?>">
                                    <div class="row">
                            @endif
                            @if (isset($r->id_jadwal))
                                <!-- bersih -->
                                <div class="col-xl-2 col-md-3 col-sm-3 col-xs-6 pb-0">
                                    <div class="card card-stats pb-0">
                                        <div class="card-img-top text-center mb-1 mt-1">
                                            <span class="card-title text-uppercase text-default"
                                                style="font-size: 15pt; font-weight: bold">{{ $r->nama_ruang }}</span><br>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body bg-gradient-green pb-0">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <span class="font-weight-bold mb-0 text-white">BERSIH</span><br>
                                                    <span class="mb-0 text-white"><small>
                                                            <?php
                                                            if (isset($r->nama_user)) {
                                                                $nama = explode(' ', $r->nama_user);
                                                                echo $nama[0];
                                                            } else {
                                                                echo 'Belum ada CS';
                                                            } ?>
                                                        </small></span>
                                                </div>
                                            </div>
                                            <p class="mt-1 mb-0 text-center pd-0">
                                                <button class="btn btn-sm btn-icon btn-neutral" data-toggle="modal"
                                                    data-target="#modalImg{{ $r->id_ruang }}">
                                                    <span class="btn-inner--icon"><i
                                                            class="ni ni-camera-compact"></i></span>
                                                    <span class="btn-inner--text">Bukti</span>
                                                </button>
                                                <!-- Modal -->
                                            <div class="pb-0 pt-0 modal fade mb-0" id="modalImg{{ $r->id_ruang }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bukti
                                                                Kebersihan dan Kerapihan</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    @foreach ($bukti as $b)
                                                                        @if ($b->id_laporan == $r->id)
                                                                            <div class="col-md-4 text-center">
                                                                                <?php $ekst = substr($b->nama_file, -3); ?>
                                                                                @if ($ekst == 'mp4' || $ekst == 'mkv' || $ekst == 'avi' || $ekst == 'mpg' || $ekst == 'mov' || $ekst == '3gp')
                                                                                    <video width="320px" height="180px"
                                                                                        controls>
                                                                                        <source
                                                                                            src="{{ asset('uploads/' . $b->nama_file) }}"
                                                                                            type="video/{{ $ekst }}">
                                                                                    </video>
                                                                                @else
                                                                                    <a href="{{ asset('uploads/' . $b->nama_file) }}"
                                                                                        target="_blank">
                                                                                        <span class='zoom'
                                                                                            id='img{{ $b->id }}'>
                                                                                            <img src="{{ asset('uploads/' . $b->nama_file) }}"
                                                                                                height="180px">
                                                                                        </span>
                                                                                    </a>
                                                                                    <script>
                                                                                        $(document).ready(function() {
                                                                                            $('#img{{ $b->id }}').zoom();
                                                                                        });
                                                                                    </script>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
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
                                            <span class="card-title text-uppercase text-default"
                                                style="font-size: 15pt; font-weight: bold">{{ $r->nama_ruang }}</span><br>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body bg-gradient-red">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <span class="font-weight-bold mb-0 text-white">BELUM BERSIH</span><br>
                                                    <span class="mb-0 text-white"><small>
                                                            <?php
                                                            if (isset($r->nama_user)) {
                                                                $nama = explode(' ', $r->nama_user);
                                                                echo $nama[0];
                                                            } else {
                                                                echo 'Belum ada CS';
                                                            } ?>
                                                        </small></span>
                                                </div>
                                            </div>
                                            <p class="mt-1 mb-0 text-center">
                                                <button class="btn btn-sm btn-icon btn-neutral" disabled>
                                                    <span class="btn-inner--icon"><i
                                                            class="ni ni-camera-compact"></i></span>
                                                    <span class="btn-inner--text">Belum Ada</span>
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($i % 18 == 0)
                    </div> <!-- row -->
                </div>
                @endif
                <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div> <!-- row -->
    </div>
    </div>
@endsection
