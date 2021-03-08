<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KK Baru</title>
</head>
<body>
    <p>YTH. {{$user->name}}</p>
    <p>Pengajuan KK baru yang anda lakukan pada tanggal {{$submission->created_at->format('d-m-Y')}} telah <b>DISETUJUI</b></p>
    <p>Anda dapat mengunduhnya melalui lampiran di-email ini.</p>
</body>
</html>
