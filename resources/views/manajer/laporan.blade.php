@extends('layout.manajer.content')

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
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> Terjadi kesalahan<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <div class="card pb-5">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Laporan Status Kebersihan Ruang</h3>
            </div>
            <div class="card-body mt-0 mb-0 pt-0">
              <form action="{{route('manajer.laporan.index')}}" method="POST">
                @csrf
                <div class="row">
                <div class="col-md-3">
                    <input class="form-control" type="date" name="tanggal_mulai" value="{{date('Y-m-d')}}">
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="date" name="tanggal_akhir" value="{{date('Y-m-d')}}">
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="status">
                      <option value="semua">Semua</option>
                      <option value="sudah">Sudah</option>
                      <option value="belum">Belum</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="submit" name="submit" value="Tampil" class="btn btn-primary">
                    <input type="submit" name="print" value="PDF" class="btn btn-danger" formtarget="_blank">
                    <input type="submit" name="excel" value="Excel" class="btn btn-success">
                </div>
                </div>
              </form>
            </div>
            <span class="ml-4 mb-4">
              <b>Laporan tanggal: {{$awal}} <?=($awal!=$akhir)?'sampai '.$akhir : ''?><br>
              Status: {{ucfirst($status)}}
              </b>
            </span>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="data">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    @if($awal!=$akhir)
                      <th scope="col" class="sort">Tanggal<i class="fas fa-sort"></th>
                    @endif
                    <th scope="col" class="sort">Ruang<i class="fas fa-sort"></th>
                    <th scope="col" class="sort">CS<i class="fas fa-sort"></th>
                    <th scope="col" class="sort">Status<i class="fas fa-sort"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php $i = 1;?>
                  @if($status == 'sudah')
                    @foreach($laporan as $r)
                      @if(isset($r->id_jadwal))
                        <tr>
                          <th scope="row">{{$i}}</th>
                          @if($awal!=$akhir)
                            <td><?=(isset($r->date))?$r->date:date('Y-m-d')?></td>
                          @endif
                          <td>{{$r->nama_ruang}}</td>
                          <td> 
                            {{(isset($r->nama_user)) ? $r->nama_user : 'Belum ada cs'}}
                          </td>
                          <td><span class="badge badge-pill badge-success">Bersih</span></td>
                        </tr>
                        <?php $i++; ?>
                      @endif
                    @endforeach
                  @elseif($status == 'belum')
                    @foreach($laporan as $r)
                      @if(!isset($r->id_jadwal))
                        <tr>
                          <th scope="row">{{$i}}</th>
                          @if($awal!=$akhir)
                            <td><?=(isset($r->date))?$r->date:date('Y-m-d')?></td>
                          @endif
                          <td>{{$r->nama_ruang}}</td>
                          <td> 
                            {{(isset($r->nama_user)) ? $r->nama_user : 'Belum ada cs'}}
                          </td>
                          <td><span class="badge badge-pill badge-danger">Belum bersih</span></td>
                        </tr>
                        <?php $i++; ?>
                      @endif
                    @endforeach
                  @else
                    @foreach($laporan as $r)
                      <tr>
                        <th scope="row">{{$i}}</th>
                          @if($awal!=$akhir)
                            <td><?=(isset($r->date))?$r->date:date('Y-m-d')?></td>
                          @endif
                        <td>{{$r->nama_ruang}}</td>
                        <td> 
                          {{(isset($r->nama_user)) ? $r->nama_user : 'Belum ada cs'}}
                        </td>
                        <td>
                          @if(isset($r->id_jadwal))
                            <span class="badge badge-pill badge-success">Bersih</span>
                          @else
                            <span class="badge badge-pill badge-danger">Belum bersih</span>
                          @endif
                        </td>
                      </tr>
                      <?php $i++; ?>
                    @endforeach
                  @endif  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection