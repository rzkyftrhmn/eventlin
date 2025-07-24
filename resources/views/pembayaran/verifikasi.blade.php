@extends('layouts.app')

@section('content')
<h2>Verifikasi Pembayaran Tiket</h2>

@if (session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nama Peserta</th>
            <th>NIM</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembayarans as $pembayaran)
            <tr>
                <td>{{ $pembayaran->peserta->nama_peserta }}</td>
                <td>{{ $pembayaran->peserta->nim }}</td>
                <td>
                    <a href="{{ asset($pembayaran->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset($pembayaran->bukti_pembayaran) }}" alt="Bukti" width="100" style="border:1px solid #ccc;">
                    </a>
                </td>
                <td>{{ $pembayaran->status_pembayaran }}</td>
                <td>
                    <form action="{{ route('verifikasi.pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status_pembayaran">
                            <option value="Menunggu" {{ $pembayaran->status_pembayaran == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Diterima" {{ $pembayaran->status_pembayaran == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ $pembayaran->status_pembayaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
