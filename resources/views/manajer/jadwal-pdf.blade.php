<?php ini_set('max_execution_time', 360)?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Jadwal Kokeru</title>
    <style>
        @page { margin: 20px 30px; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; }
        table { border-collapse: collapse; width: 100%; }
        .table { margin-top: 10px; }
        .table th, .table td { padding: 6px; border: 1px solid #dee2e6; }
        .table th { background: #f2f2f2; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <?php
    $path = public_path('assets/img/brand/LogoUIS.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = @file_get_contents($path);
    $base64Logo = $data ? 'data:image/' . $type . ';base64,' . base64_encode($data) : '';
    ?>

    <table style="width:100%; border:none;">
        <tr>
            <td style="width:15%; border:none; text-align:center; vertical-align:middle;">
                @if($base64Logo)
                    <img src="{{ $base64Logo }}" style="height:80px; width:auto;">
                @endif
            </td>
            <td style="width:85%; border:none; text-align:center; vertical-align:middle;">
                <span style="font-size:12pt; font-weight:bold;">YAYASAN PENDIDIKAN IBNU SINA BATAM (YAPISTA)</span><br>
                <span style="font-size:16pt; font-weight:bold;">UNIVERSITAS IBNU SINA (UIS)</span><br>
                <span style="font-size:9pt;">Jalan Teuku Umar, Lubuk Baja, Kota Batam-Indonesia Telp. 0778 – 408 3113</span><br>
                <span style="font-size:9pt;">Email : info@uis.ac.id / uibnusina@gmail.com &nbsp;|&nbsp; Website : uis.ac.id</span>
            </td>
        </tr>
    </table>

    <hr style="border: 1px solid black; margin-top: 10px; margin-bottom: 15px;">

    <table style="width:100%; border:none; margin-bottom: 20px;">
        <tr>
            <td style="text-align:center; border:none;">
                <b style="font-size:14pt; text-transform:uppercase;">Data Penugasan Cleaning Service</b>
            </td>
        </tr>
        <tr>
            <td style="text-align:center; border:none; padding-top: 8px; font-size:11pt;">
                CS: <b>{{ $nama_cs }}</b>
            </td>
        </tr>
    </table>

    <table class="table">
        <tr>
            <th class="center" style="width:10%">No</th>
            <th class="center" style="width:30%">Ruang</th>
            <th style="width:60%">Nama CS</th>
        </tr>
        <?php $i = 1;?>
        @foreach($jadwal as $r)
            <tr>
                <td class="center">{{$i}}</td>
                <td class="center">{{$r->nama_ruang}}</td>
                <td>{{$r->nama_user}}</td>
            </tr>
            <?php $i++; ?>
        @endforeach
    </table>

    <table style="width:100%; border:none; margin-top:30px;">
        <tr>
            <td style="width:50%; border:none; text-align:center;">
                Batam, {{date('d F Y')}}<br>
                <strong>Ka. Bid Sarpras</strong><br><br><br><br><br>
                <u style="letter-spacing:2px;">_________________________</u><br>
                Nup. _______________
            </td>
            <td style="width:50%; border:none; text-align:center;">
                Batam, {{date('d F Y')}}<br>
                <strong>Manajer</strong><br><br><br><br><br>
                <u>{{Auth::user()->nama_user}}</u><br>
                Manajer
            </td>
        </tr>
    </table>
</body>
</html>