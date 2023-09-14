<?php ini_set('max_execution_time', 360)?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kokeru</title>
	<style type="text/css">
		table {
    		border-collapse: collapse;
		}
		.table{
		    width: 100%;
		    margin-bottom: 0.5rem;
		    margin-top: 1.9rem;
		    color: #212529;
		}
		.table th,
		.table td{
		    padding: .75rem;
		    vertical-align: top;
		    border-top: 1px solid #dee2e6;
		}
		.table th{
		    vertical-align: bottom;
		    border-bottom: 2px solid #dee2e6;
		}
		.center{
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
		function hari($day){
			switch ($day) {
				case 'Sun':
					$hari = 'Minggu';
					break;
				case 'Mon':
					$hari = 'Senin';
					break;
				case 'Tue':
					$hari = 'Selasa';
					break;
				case 'Wed':
					$hari = 'Rabu';
					break;
				case 'Thu':
					$hari = 'Kamis';
					break;
				case 'Fri':
					$hari = 'Jumat';
					break;
				case 'Sat':
					$hari = 'Sabtu';
					break;
			}
			return $hari;
		}
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="text-align: center">
				<h3>Laporan Harian Kebersihan dan Kerapihan Ruangan Gedung Bersama Maju</h3>
				<h3 style="margin-top:0px"><?=($awal==$akhir)?'Hari '.hari(date('D', strtotime($awal))) : ''?> Tanggal {{date('d F Y', strtotime($awal))}} <?=($awal!=$akhir) ? ' - '.date('d F Y', strtotime($akhir)) : ''?></h3>
				<i style="margin-top:0px">Tanggal Cetak {{date('d F Y')}} Jam {{date('h:i')}} WIB</i>
			</div>
		</div>
	</div>
	<table class="table">
		<tr>
			<th style="width:5%">No</th>
			@if($awal!=$akhir)
				<th style="width:15%">Tanggal</th>
			@endif
			<th style="width:15%">Ruang</th>
			<th style="width:45%">Nama CS</th>
			<th style="width:20%">Status</th>
		</tr>
		<?php $i = 1;?>
            @if($status == 'sudah')
                @foreach($laporan as $r)
                    @if(isset($r->id_jadwal))
                        <tr>
                          <td class="center">{{$i}}</td>
                          @if($awal!=$akhir)
                            <td><?=(isset($r->date))?$r->date:date('Y-m-d')?></td>
                          @endif
                          <td class="center">{{$r->nama_ruang}}</td>
                          <td> 
                            {{(isset($r->nama_user)) ? $r->nama_user : 'Belum ada cs'}}
                          </td>
                          <td class="center">Bersih</td>
                        </tr>
                        <?php $i++; ?>
                    @endif
                @endforeach
            @elseif($status == 'belum')
                @foreach($laporan as $r)
                    @if(!isset($r->id_jadwal))
                        <tr>
                          <td class="center">{{$i}}</td>
                          @if($awal!=$akhir)
                            <td><?=(isset($r->date))?$r->date:date('Y-m-d')?></td>
                          @endif
                          <td class="center">{{$r->nama_ruang}}</td>
                          <td> 
                            {{(isset($r->nama_user)) ? $r->nama_user : 'Belum ada cs'}}
                          </td>
                          <td class="center">Belum bersih</td>
                        </tr>
                        <?php $i++; ?>
                    @endif
                @endforeach
            @else
                @foreach($laporan as $r)
                    <tr>
                        <td class="center">{{$i}}</td>
                        @if($awal!=$akhir)
                            <td><?=(isset($r->date))?$r->date:date('Y-m-d')?></td>
                          @endif
                        <td class="center">{{$r->nama_ruang}}</td>
                        <td> 
                          {{(isset($r->nama_user)) ? $r->nama_user : 'Belum ada cs'}}
                        </td>
                        <td class="center">
                          @if(isset($r->id_jadwal))
                            Bersih
                          @else
                            Belum bersih
                          @endif
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            @endif
	</table>
	<hr style="border-top: 1px solid; color: #dee2e6">
	<div style="padding-top: 10px; padding-left: 550px">
		Approval<br><br><br><br><br>
		{{Auth::user()->nama_user}}<br>
		Manajer
	</div>
</body>
</html>