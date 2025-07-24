@extends('peserta.dashboard')

@section('content')

<div class="home-event">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-event">
                    <div class="home-title">
                        <h3>Profile</h3>
                    </div>
                    <div class="title-home-event d-flex">
                        <a href="{{ route('peserta.content_dashboard') }}">
                            <img src="{{ asset('assets/img-peserta/home.png')}}" height="23" alt="">
                        </a>
                        <p>/ Profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="max-w-2xl mx-auto bg-white p-5 rounded shadow">

        <div class="mb-3">
            <strong>Nama:</strong>
            <p>{{ $peserta->nama_peserta }}</p>
        </div>

        <div class="mb-3">
            <strong>Email:</strong>
            <p>{{ $peserta->email }}</p>
        </div>

        <div class="mb-3">
            <strong>NIM:</strong>
            <p>{{ $peserta->nim }}</p>
        </div>

        <div class="mb-3">
            <strong>Tanggal Pendaftaran:</strong>
            <p>{{ \Carbon\Carbon::parse($peserta->tanggal_pendaftaran)->translatedFormat('d F Y') }}</p>
        </div>

        <div class="mb-3">
            <strong>Acara / Proposal Diikuti:</strong>
            <p>{{ $peserta->proposal->nama_acara ?? '-' }}</p>
        </div>
    </div>
</div>

@endsection