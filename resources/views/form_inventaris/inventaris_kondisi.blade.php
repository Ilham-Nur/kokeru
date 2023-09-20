<div class="card">
    <div class="card-header">Data Kondisi Inventaris Bulan {{ $bulan }}
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

                <div class="col-6">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Bulan</label>
                        <input type="text" class="form-control" id="tahun" value="{{ $bulan }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun" value="{{ $tahun }}" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Tabel Data Inventaris</div>
    <div class="card-body">
        <form action="">
            <div class="float-right my-3">
                <a href="" class="btn btn-primary">
                    Simpan
                </a>
            </div>
            <div>
                <table class="w-100 table table-bordered table-responsive-xl">
                    <thead>
                        <tr>
                            <th>No</th>
                            <td>Sarana</td>
                            <td>Bulan</td>
                            <td>kuantiti</td>
                            <td>kondisi</td>
                            <td>dipinjam</td>
                            <td>mutasi</td>
                            <td>user</td>
                            <td>sign</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ( $sarana as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->nama_sarana }}</td>
                            <td>
                                {{ $bulan }}
                            </td>
                            <td>
                                <input type="radio" id="kuantiti_ya{{ $item->nama_sarana }}"
                                    name="kuantiti{{ $item->nama_sarana }}" value="ya">
                                <label for="kuantiti_ya{{ $item->nama_sarana }}">Ya</label>
                                |
                                <input type="radio" id="kuantiti_tidak{{ $item->nama_sarana }}"
                                    name="kuantiti{{ $item->nama_sarana }}" value="tidak">
                                <label for="kuantiti_tidak{{ $item->nama_sarana }}">Tidak</label>
                            </td>

                            <td>
                                <input type="radio" id="kondisi_ya{{ $item->nama_sarana }}"
                                    name="kondisi{{ $item->nama_sarana }}" value="ya">
                                <label for="kondisi_ya{{ $item->nama_sarana }}">Ya</label>
                                |
                                <input type="radio" id="kondisi_tidak{{ $item->nama_sarana }}"
                                    name="kondisi{{ $item->nama_sarana }}" value="tidak">
                                <label for="kondisi_tidak{{ $item->nama_sarana }}">Tidak</label>
                            </td>
                            <td>
                                <input type="radio" id="dipinjam_ya{{ $item->nama_sarana }}"
                                    name="dipinjam{{ $item->nama_sarana }}" value="ya">
                                <label for="dipinjam_ya{{ $item->nama_sarana }}">Ya</label>
                                |
                                <input type="radio" id="dipinjam_tidak{{ $item->nama_sarana }}"
                                    name="dipinjam{{ $item->nama_sarana }}" value="tidak">
                                <label for="dipinjam_tidak{{ $item->nama_sarana }}">Tidak</label>
                            </td>
                            <td>
                                <input type="radio" id="mutasi_ya{{ $item->nama_sarana }}"
                                    name="mutasi{{ $item->nama_sarana }}" value="ya">
                                <label for="mutasi_ya{{ $item->nama_sarana }}">Ya</label>
                                |
                                <input type="radio" id="mutasi_tidak{{ $item->nama_sarana }}"
                                    name="mutasi{{ $item->nama_sarana }}" value="tidak">
                                <label for="mutasi_tidak{{ $item->nama_sarana }}">Tidak</label>
                            </td>
                            <td>
                                <input type="radio" id="user_ya{{ $item->nama_sarana }}"
                                    name="user{{ $item->nama_sarana }}" value="ya">
                                <label for="user_ya{{ $item->nama_sarana }}">Ya</label>
                                |
                                <input type="radio" id="user_tidak{{ $item->nama_sarana }}"
                                    name="user{{ $item->nama_sarana }}" value="tidak">
                                <label for="user_tidak{{ $item->nama_sarana }}">Tidak</label>
                            </td>
                            <td>
                                <input type="radio" id="sign_ya{{ $item->nama_sarana }}"
                                    name="sign{{ $item->nama_sarana }}" value="ya">
                                <label for="sign_ya{{ $item->nama_sarana }}">Ya</label>
                                |
                                <input type="radio" id="sign_tidak{{ $item->nama_sarana }}"
                                    name="sign{{ $item->nama_sarana }}" value="tidak">
                                <label for="sign_tidak{{ $item->nama_sarana }}">Tidak</label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>