<div class="card">
    <div class="card-header">Data Kondisi Sarana
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <input type="text" class="form-control" id="ruangan" aria-describedby="ruangan"
                            value="{{ $ruang->nama_ruang }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="pj_ruangan" class="form-label">PJ Ruangan</label>
                        <input type="text" class="form-control" id="pj_ruangan" value="{{ $ruang->pj_ruang }}" readonly>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Tabel Data Inventaris Sarana</div>
    <div class="card-body">
        <div class="float-right my-3">
            @if (auth()->user()->manajer==1)
            <a href="{{ route('manager.inventaris..sarana.create', $id_ruang) }}" class="btn btn-primary">
                Tambah
            </a>
            @else
            <a href="{{ route('cs.inventaris..sarana.create', $id_ruang) }}" class="btn btn-primary">
                Tambah
            </a>
            @endif
        </div>
        <div>
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr class="text-center">
                        <th scope="col">NO</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Sarana</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sarana as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama_sarana }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if (auth()->user()->manajer==1)
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('manager.inventaris..sarana.edit',['id' =>  $item->id, 'id_ruang' => $id_ruang]) }}">Edit</a>
                                @else
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('cs.inventaris..sarana.edit',['id' =>  $item->id, 'id_ruang' => $id_ruang]) }}">Edit</a>
                                @endif
                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                                    data-target="#konfirmDelete{{$item->id}}">
                                    Delete
                                </a>
                            </div>
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
                                                Anda yakin ingin menghapus data ruang {{$item->id}} ?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form
                                        action="{{ route('cs.inventaris..sarana.destroy',['id' =>  $item->id, 'id_ruang' => $id_ruang]) }}"
                                        method="POST">
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