@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Profil Peserta</h2>

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

    <div class="mt-5">
        <a href="{{ route('peserta.edit', $peserta->nim) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
            Edit Profil
        </a>
    </div>
</div>
@endsection
