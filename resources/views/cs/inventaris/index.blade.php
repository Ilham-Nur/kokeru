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
            <div class="card pb-5">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Data Ruang</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="data">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="sort" data-sort="name">ID <i class="fas fa-sort"></th>
                                <th scope="col" class="sort">Nama Ruang <i class="fas fa-sort"></th>
                                <th scope="col" class="sort">Inventaris Sarana <i class="fas fa-sort"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($ruang as $r)
                            <tr class="text-center">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $r->ruang->nama_ruang }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#inventaris{{ $r->id }}">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <a class="btn btn-sm btn-secondary"
                                        href="{{ route('cs.inventaris.sarana', $r->id) }}"><i
                                            class="fas fas fa-plus"></i></a>
                                </td>
                       
                            </tr>
                            {{-- Modal Delete --}}
                            <div class="modal fade" id="konfirmDelete{{$r->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="{{$r->id}}" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary border-0 mb-0">
                                                <div class="card-body px-lg-5 py-lg-5">
                                                    <div class=" text-default mb-0">
                                                        Anda yakin ingin menghapus data ruang {{$r->nama_ruang}} ?
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('ruang.destroy',$r->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <a href="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Inventaris-->
                            <div class="modal fade" id="inventaris{{ $r->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="staticBackdropLabel">Data Inventaris</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div>
                                                    <h4>Ruangan : <span class="text-muted">{{ $r->ruang->nama_ruang }}</span>
                                                    </h4>
                                                    <h4>Pj Ruangan : <span class="text-muted">AMIN</span></h4>
                                                    <h4>Tahun : <span class="text-muted">2024</span></h4>
                                                </div>

                                                <div class="my-4">
                                                    <h4>Bulan</h4>
                                                    <div class="row">
                                                        <div class="row">
                                                            @foreach ($bulanList as $bulan)
                                                            @php
                                                            $bulanSingkat = substr($bulan, 0, 3); // Mengambil tiga
                                                            @endphp
                                                            <div class="col-md-4">
                                                                <a href="{{ route('cs.inventaris.bulan', ['bulan' => $bulan, 'id_ruang' => $r->id]) }}"
                                                                    class="btn btn-success my-2 w-100">{{ $bulanSingkat
                                                                    }}</a>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection