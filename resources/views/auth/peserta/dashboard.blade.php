@extends('peserta.dashboard')
@section('content')
<div class="section-hero text-center text-white" style="background-image: url('/assets/img-peserta/bg_home.jpg');">
    <h2>Jadilah bagian dari moment yang menginspirasi!</h2>
</div>
    <h2>Dashboard Peserta</h2>
    <p>Selamat datang, {{ $peserta->nama_peserta }}!</p>
    <p>Terdaftar di Acara: {{ $peserta->proposal->nama_acara }}</p>
@endsection
