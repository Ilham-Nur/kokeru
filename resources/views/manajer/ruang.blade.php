@extends('layout.manajer.content')

@section('top-menu')
  <button type="button" class="btn btn-sm btn-default mt-0 ml-8" data-toggle="modal" data-target="#modal-form">Tambah Ruang</button>
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
                <form role="form" method="POST" action="{{route('ruang.store')}}">
                  @csrf
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                            </div>
                            @foreach($last as $l)
                              <?php $id = $l->id+1; ?>
                              <input class="form-control" type="text" name="id" value="{{$id}}" style="padding-left: 5pt" readonly>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                            </div>
                            <input class="form-control" name="nama_ruang" placeholder="Nama Ruang" type="text" required minlength="3" maxlength="5">
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Tambah"></input>
                        <button type="reset" class="btn btn-md btn-danger">Reset</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
            <div class="card-header border-0">
              <h3 class="mb-0">Data Ruang</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="data">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">ID <i class="fas fa-sort"></th>
                    <th scope="col" class="sort">Nama Ruang <i class="fas fa-sort"></th>
                    <th scope="col" class="sort">Aksi</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($ruang as $r)
                  <tr>
                    <th scope="row">{{$r->id}}</th>
                    <td>{{$r->nama_ruang}}</td>
                    <td>
                      <a class="btn btn-warning btn-sm" href="{{route('ruang.edit', $r->id)}}">Edit</a>&nbsp;&nbsp; 
                      <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#konfirmDelete{{$r->id}}">Delete</a>
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
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection