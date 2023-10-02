<div class="div">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <input type="text" class="form-control" id="ruangan" aria-describedby="ruangan" value="{{ $ruang->nama_ruang }}" readonly>
        </div>
        <div class="mb-3">
            <label for="no_seri_ac" class="form-label">No Seri Ac</label>
            <input type="text"  class="form-control" id="no_seri_ac" value="{{ $data_ac->no_seri }}" readonly>
        </div>

        <div class="mb-3">
            <label for="jenis_ac" class="form-label">Jenis Ac</label>
            <input type="text" class="form-control" id="jenis_ac" value="{{ $data_ac->jenis }}" readonly>
        </div>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <label for="merk_ac" class="form-label">Merk Ac</label>
            <input type="text" class="form-control" id="merk_ac" value="{{ $data_ac->merk }}" readonly>
        </div>
        <div class="mb-3">
            <label for="type_ac" class="form-label">Type Ac</label>
            <input type="text"  class="form-control" id="type_ac" value="{{ $data_ac->type }}" readonly>
        </div>
        <div class="mb-3">
            <label for="kapasitas_ac" class="form-label">Kapasitas Ac</label>
            <input type="text"  class="form-control" id="kapasitas_ac" value="{{ $data_ac->kapasitas }}" readonly>
        </div>

    </div>
</div>
<hr>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $data_pemeliharaan->tanggal }}">
        </div>

        <div class="mb-3">
            <label for="arus_ac" class="form-label">Arus</label>
            <input type="number" name="arus" class="form-control" id="arus_ac" value="{{ $data_pemeliharaan->arus }}">
        </div>
        <div class="mb-3">
            <label for="tegangan_ac" class="form-label">Tegangan</label>
            <input type="number" name="tegangan" class="form-control" id="tegangan_ac" value="{{ $data_pemeliharaan->tegangan }}">
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tekanan_ac" class="form-label">Tekanan</label>
            <input type="number" name="tekanan" class="form-control" id="tekanan_ac" value="{{ $data_pemeliharaan->tekanan }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="description" value="{{ $data_pemeliharaan->description }}">
        </div>
        <div class="mb-3">
            <label for="remaks" class="form-label">Remaks</label>
            <input type="text" name="remaks" class="form-control" id="remaks" value="{{ $data_pemeliharaan->remaks }}">
        </div>
    </div>
</div>