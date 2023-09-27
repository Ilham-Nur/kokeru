@extends('layout.manajer.content')

@section('top-menu')
<button type="button" class="btn btn-sm btn-default mt-0 ml-8" data-toggle="modal" data-target="#modal-form">Tambah
    CS</button>
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
                    <div class="card-body text-left">
                        <form action="{{ route('manajer.mitraac.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_user">Nama</label>
                                <input type="text" name="nama_user" class="form-control text-dark" id="nama_user">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control text-dark" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="email">
                                <small id="emailHelp" class="form-text text-warning">* Password Akan Dikirim melalui
                                    email</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
                    <h3 class="mb-0">Data CS</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="data">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="sort" data-sort="name">NO <i class="fas fa-sort"></th>
                                <th scope="col" class="sort">Nama<i class="fas fa-sort"></th>
                                <th scope="col" class="sort">Email <i class="fas fa-sort"></th>
                                <th scope="col" class="sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($mitra as $item)
                            <tr class="text-center">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->nama_user}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    {{-- <a class="btn btn-warning btn-sm"
                                        href="{{route('cs.edit', $item->id)}}">Edit</a>&nbsp;&nbsp; --}}
                                    <a class="btn btn-warning btn-sm" href="#" data-toggle="modal"
                                        data-target="#editModal{{$item->id}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                                        data-target="#konfirmDelete{{$item->id}}">Delete</a>
                                </td>
                            </tr>

                            {{-- Modal Delete --}}
                            <div class="modal fade" id="konfirmDelete{{$item->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="{{$item->id}}" aria-hidden="true">
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
                                                        Anda yakin ingin menghapus data cs {{$item->nama_user}} ?
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('manajer.mitraac.destroy',$item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <a href="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editModal{{ $item->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('manajer.mitraac.update',$item->id) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama_user">Nama</label>
                                                <input type="text" name="nama_user" class="form-control text-dark" id="nama_user" value="{{ $item->nama_user }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control text-dark" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="email" value="{{ $item->email }}">
                                                <small id="emailHelp" class="form-text text-warning">* Password Akan Dikirim melalui
                                                    email</small>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
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