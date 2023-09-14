<!DOCTYPE html>
<html>
<head>
    <title>Kokeru</title>
</head>
<body>
    <h2>{{ $details['title'] }}</h2>
    Hallo {{$details['nama']}}!<br>
    Akun sistem Kokeru dengan hak akses sebagai cleaning service berhasil dibuat. Berikut adalah data akun Anda.
	<br>
    Email: {{$details['email']}}<br>
	Password: {{$details['pass']}}
	<br><br>
	Disarankan Anda segera mengubah password setelah login dengan alasan keamanan akun Anda.<br>
	Terima kasih.
</body>
</html>