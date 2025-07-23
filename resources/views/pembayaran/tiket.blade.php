@extends('layouts.app')

@section('content')
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
