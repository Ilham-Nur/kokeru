@extends('layout.mitraAc.content')
@section('content')
<div class="card">
  <div class="card-header">
    <h4>Data Pemeliharaan Ac</h4>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered table-responsive-sm" id="data">
          <thead>
            <tr class="text-center">
              <th scope="col">No</th>
              <th scope="col">No Seri</th>
              <th scope="col">Jenis</th>
              <th scope="col">Merk</th>
              <th scope="col">Type</th>
              <th scope="col">Kapasitas</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $data_ac as $item)
            <tr class="text-center">
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->no_seri }}</td>
              <td>{{ $item->jenis }}</td>
              <td>{{ $item->merk }}</td>
              <td>{{ $item->type }}</td>
              <td>{{ $item->kapasitas }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#staticBackdrop{{ $item->id }}">
                  Laporan
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-backdrop="static" data-keyboard="false"
                  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Data Pemeliharaan AC</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="float-right">
                              <a class="btn btn-sm btn-primary  mb-3"
                                href="{{ route('mitra.pemeliharaan.create', ['id_ruang' => $id_ruang, 'id_ac' => $item->id]) }}">Tambah
                                Data</a>
                            </div>
                            <hr>
                            <table class="table table-bordered table-responsive-sm">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Tanggal</th>
                                  <th scope="col">Arus</th>
                                  <th scope="col">Tegangan</th>
                                  <th scope="col">Tekanan</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Remaks</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($item->dataAcs as $dataPemeliharaan)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $dataPemeliharaan->tanggal }}</td>
                                  <td>{{ $dataPemeliharaan->arus }}</td>
                                  <td>{{ $dataPemeliharaan->tegangan }}</td>
                                  <td>{{ $dataPemeliharaan->tekanan }}</td>
                                  <td>{{ $dataPemeliharaan->description }}</td>
                                  <td>{{ $dataPemeliharaan->remaks }}</td>
                                  <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('mitra.pemeliharaan.edit', ['id_ruang' => $id_ruang, 'id_pemeliharaan' => $dataPemeliharaan->id, 'id_ac' => $item->id]) }}">Edit</a>
                                  </td>
                                </tr>
                                @endforeach
                             
                              </tbody>
                            </table>
                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>


            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection