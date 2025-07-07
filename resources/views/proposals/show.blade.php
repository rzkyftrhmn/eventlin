@extends('layouts.app')

@section('content')
    <h1>Detail Proposal</h1>

    <p><strong>Nama Acara:</strong> {{ $proposal->nama_acara }}</p>
    <p><strong>Jenis Acara:</strong> {{ $proposal->jenis_acara }}</p>
    <p><strong>Nama Pengusul:</strong> {{ $proposal->nama_pengusul }}</p>
    <p><strong>Judul Proposal:</strong> {{ $proposal->judul_proposal }}</p>
    <p><strong>Status:</strong> {{ $proposal->status_proposal }}</p>
    <p><strong>File Proposal:</strong> <a href="{{ asset('proposals/' . $proposal->file_proposal) }}" target="_blank">Lihat File</a></p>
    <p><strong>Estimasi Peserta:</strong> {{ $proposal->estimasi_peserta }}</p>
    <p><strong>Kebutuhan Logistik:</strong> {{ $proposal->kebutuhan_logistik }}</p>
    <p><strong>Tanggal Acara:</strong> {{ $proposal->tanggal_acara }}</p>
    <p><strong>Waktu Acara:</strong> {{ $proposal->waktu_acara }}</p>
    <p><strong>Detail Acara:</strong> {{ $proposal->detail_acara }}</p>

    <a href="{{ route('proposals.index') }}">Kembali</a>
@endsection
