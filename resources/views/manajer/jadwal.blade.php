@extends('layout.manajer.content')

@section('top-menu')
@php $isReadOnly = auth()->user()->manajer == 1 && auth()->user()->mitra == 1; @endphp
@if(!$isReadOnly)
  <a href="{{route('jadwal.create')}}">
    <button type="button" class="btn btn-sm btn-default mt-0 ml-8">Tambah Jadwal</button>
  </a>
@endif
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
              <h3 class="mb-0">Data Jadwal</h3>
            </div>
            <div class="card-body mt-0 mb-0 pt-0">
              <form action="{{route('manajer.jadwal.index')}}" method="POST">
                @csrf
                <div class="row">
                <div class="col-md-4">
                    <select class="form-control" name="user">
                      <option value="all">Semua CS</option>
                      @foreach($cs as $r)
                        <option value="{{$r->id}}">{{$r->nama_user}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" name="submit" value="Lihat Jadwal" class="btn btn-primary">
                </div>
                </div>
              </form>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="data">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col" class="sort">Ruang<i class="fas fa-sort"></th>
                    <th scope="col" class="sort">Nama CS<i class="fas fa-sort"></th>
                    @if(!$isReadOnly)
                    <th scope="col" class="sort">Aksi</th>
                    @endif
                  </tr>
                </thead>
                <tbody class="list">
                  <?php $i = 1;?>
                  @foreach($jadwal as $r)
                  <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$r->nama_ruang}}</td>
                    <td>{{$r->nama_user}}</td>
                    <td>
                      @if(!$isReadOnly)
                      <a class="btn btn-warning btn-sm" href="{{route('jadwal.edit', $r->id)}}">Edit</a>&nbsp;&nbsp;
                      <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#konfirmDelete{{$r->id}}">Delete</a>
                      @endif
                    </td>
                  </tr>
                  <div class="modal fade" id="konfirmDelete{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$r->id}}" aria-hidden="true">
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
                                Anda yakin ingin menghapus data jadwal ini ?
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('jadwal.destroy',$r->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                          <a href="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $i++;?>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection