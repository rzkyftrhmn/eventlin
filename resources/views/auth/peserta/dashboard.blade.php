@extends('peserta.dashboard')
@section('content')
<div class="home-event">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-event">
                    <div class="home-title">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="title-home-event d-flex">
                        <div>
                            <img src="{{ asset('assets/img-peserta/home.png')}}" height="23" alt="">
                        </div>
                        <p>/ </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="dashboard-peserta">
        <h2>Dashboard Peserta</h2>
        <p>Selamat datang, {{ $peserta->nama_peserta }}!</p>
        <p>Terdaftar di Acara: {{ $peserta->proposal->nama_acara }}</p>
        <p>Tanggal Acara: {{ $peserta->proposal->tanggal_acara }}</p>
        <p>Waktu Acara: {{ $peserta->proposal->waktu_acara }}</p>
    </div>
</div>

@endsection
