<div>
    <div class="mb-3">
        <label for="kode_sarana" class="form-label">Kode  Sarana</label>
        <input type="text" class="form-control" id="kode_sarana" name="kode" value="{{ $inventaris->kode , old( 'kode_sarana') }}">
    </div>
    <div class="mb-3">
        <label for="nama_sarana" class="form-label">Nama Sarana</label>
        <input type="text" class="form-control" name="nama_sarana" id="nama_sarana" value="{{  $inventaris->nama_sarana, old('nama_sarana') }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>