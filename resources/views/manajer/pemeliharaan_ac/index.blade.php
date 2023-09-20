@extends('layout.manajer.content')
@section('top-menu')

@endsection

@section('content')
<div class="card">
    <div class="card-header">Data Pemeliharaan AC

    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <input type="text" class="form-control" id="ruangan" aria-describedby="ruangan" value="{{ $ruang->nama_ruang }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="pj_ruangan" class="form-label">PJ Ruangan</label>
                        <input type="text" class="form-control" id="pj_ruangan"  value="{{ $ruang->pj_ruang }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mitra" class="form-label">Mitra</label>
                        <input type="text" class="form-control" id="mitra">
                    </div>
                    <div class="mb-3">
                        <label for="no_seri_ac" class="form-label">No Seri Ac</label>
                        <input type="text" class="form-control" id="no_seri_ac">
                    </div>
                </div>

                <div class="col-6">


                    <div class="mb-3">
                        <label for="jenis_ac" class="form-label">Jenis Ac</label>
                        <input type="text" class="form-control" id="jenis_ac">
                    </div>
                    <div class="mb-3">
                        <label for="merk_ac" class="form-label">Merk Ac</label>
                        <input type="text" class="form-control" id="merk_ac">
                    </div>
                    <div class="mb-3">
                        <label for="type_ac" class="form-label">Type Ac</label>
                        <input type="text" class="form-control" id="type_ac">
                    </div>
                    <div class="mb-3">
                        <label for="kapasitas_ac" class="form-label">Kapasitas Ac</label>
                        <input type="text" class="form-control" id="kapasitas_ac">
                    </div>

                </div>
            </div>

            <div>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Tabel Data Inventaris</div>
    <div class="card-body">
        <div class="float-right my-3">
            <a href="" class="btn btn-primary">
                Kontrol
            </a>
        </div>
        <div>
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Description</th>
                        <th scope="col">Arus</th>
                        <th scope="col">Tegangan</th>
                        <th scope="col">Tekanan</th>
                        <th scope="col">Remaks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>Mark</td>
                        <td>@mdo</td>
                    </tr>
                   

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection