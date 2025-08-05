@extends('peserta.dashboard')

@section('content')
<div class="home-event">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-event">
                    <div class="home-title">
                        <h3>Tiket</h3>
                    </div>
                    <div class="title-home-event d-flex">
                        <a href="{{ route('peserta.content_dashboard') }}">
                            <img src="{{ asset('assets/img-peserta/home.png')}}" height="23" alt="">
                        </a>
                        <p>/ Tiket</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tiket Peserta</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $peserta->nama_peserta }}</p>
            <p><strong>NIM:</strong> {{ $peserta->nim }}</p>
            <p><strong>Acara:</strong> {{ $peserta->proposal->nama_acara }}</p>
            <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($peserta->proposal->tanggal_acara)->format('d M Y, H:i') }}</p>

            <div class="alert alert-success mt-4">
                <strong>Pembayaran Terverifikasi</strong>
            </div>

            <a href="{{ route('pembayaran.download', $peserta->nim) }}" class="btn btn-success">
                <i class="bi bi-download"></i> Download PDF
            </a>
        </div>
    </div>
</div>
@endsection
