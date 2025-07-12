@extends('layouts.app')

@section('content')
    <h2>Daftar Peserta</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('peserta.create') }}">+ Tambah Peserta</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Proposal</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesertas as $peserta)
                <tr>
                    <td>{{ $peserta->nim }}</td>
                    <td>{{ $peserta->nama_peserta }}</td>
                    <td>{{ $peserta->email }}</td>
                    <td>{{ $peserta->proposal->nama_kegiatan ?? '-' }}</td>
                    <td>{{ $peserta->status_pendaftaran }}</td>
                    <td>{{ \Carbon\Carbon::parse($peserta->tanggal_pendaftaran)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('peserta.edit', $peserta->nim) }}">Edit</a> |
