@php $isReadOnly = auth()->user()->manajer == 1 && auth()->user()->mitra == 1; @endphp

<div class="card">
    <div class="card-header border-0">
        <h3 class="mb-0">Data Kondisi Sarana</h3>
    </div>
    
    <div class="card-body mt-0 pt-0">
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
    <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Tabel Data Inventaris Sarana</h3>
        
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>

            @if(!$isReadOnly)
                @if (auth()->user()->manajer==1)
                <a href="{{ route('manager.inventaris..sarana.create', $id_ruang) }}" class="btn btn-primary ml-2">
                    Tambah
                </a>
                @else
                <a href="{{ route('cs.inventaris..sarana.create', $id_ruang) }}" class="btn btn-primary ml-2">
                    Tambah
                </a>
                @endif
            @endif
        </div>
    </div>

    <div class="card-body mt-0 pt-0">
        <div class="table-responsive">
            <table class="table table-bordered table-flush" id="data">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">NO</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Sarana</th>
                        {{-- Kolom Aksi di Header dihilangkan jika ReadOnly --}}
                        @if(!$isReadOnly)
                        <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sarana as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama_sarana }}</td>
                        
                        {{-- Kolom Aksi di Body dihilangkan jika ReadOnly --}}
                        @if(!$isReadOnly)
                        <td>
                            <div class="d-flex justify-content-center">
                                @if (auth()->user()->manajer==1)
                                <a class="btn btn-warning btn-sm mr-2"
                                    href="{{ route('manager.inventaris..sarana.edit',['id' =>  $item->id, 'id_ruang' => $id_ruang]) }}">Edit</a>
                                @else
                                <a class="btn btn-warning btn-sm mr-2"
                                    href="{{ route('cs.inventaris..sarana.edit',['id' =>  $item->id, 'id_ruang' => $id_ruang]) }}">Edit</a>
                                @endif
                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                                    data-target="#konfirmDelete{{$item->id}}">
                                    Delete
                                </a>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DELETE --}}
@if(!$isReadOnly)
    @foreach ($sarana as $item)
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
                                Anda yakin ingin menghapus data sarana {{$item->nama_sarana}} ?
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
@endif