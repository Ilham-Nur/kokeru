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
            <input type="text" class="form-control" id="ruangan" aria-describedby="ruangan"
                value="{{ $ruang->nama_ruang }}" readonly>
        </div>
        <div class="mb-3">
            <label for="no_seri_ac" class="form-label">No Seri Ac</label>
            <input type="text" name="no_seri" class="form-control" id="no_seri_ac" value="{{ $data_ac->no_seri }}">
        </div>

        <div class="mb-3">
            <label for="jenis_ac" class="form-label">Jenis Ac</label>
            <input type="text" name="jenis" class="form-control" id="jenis_ac" value="{{ $data_ac->jenis }}">
        </div>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <label for="merk_ac" class="form-label">Merk Ac</label>
            <input type="text" name="merk" class="form-control" id="merk_ac" value="{{ $data_ac->merk }}">
        </div>
        <div class="mb-3">
            <label for="type_ac" class="form-label">Type Ac</label>
            <input type="text" name="type" class="form-control" id="type_ac" value="{{ $data_ac->type }}">
        </div>
        <div class="mb-3">
            <label for="kapasitas_ac" class="form-label">Kapasitas Ac</label>
            <input type="text" name="kapasitas" class="form-control" id="kapasitas_ac" value="{{ $data_ac->kapasitas }}">
        </div>

    </div>
</div>