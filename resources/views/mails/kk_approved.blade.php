@component('mail::message')
# Pemberitahuan

Yth. {{$user->name}},

Pengajuan pembaruan KK yang anda lakukan pada tanggal {{$submission->created_at->format('d-m-Y')}} telah __DISETUJUI__

Anda dapat mengunduhnya melalui lampiran di-email ini.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
