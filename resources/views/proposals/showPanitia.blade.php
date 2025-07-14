@extends('layouts.app')

@section('content')
    <h1>Detail Proposal</h1>

    <p><strong>Nama Acara:</strong> {{ $proposal->nama_acara }}</p>
    <p><strong>Jenis Acara:</strong> {{ $proposal->jenis_acara }}</p>
    <p><strong>Nama Pengusul:</strong> {{ $proposal->nama_pengusul }}</p>
    <p><strong>Judul Proposal:</strong> {{ $proposal->judul_proposal }}</p>
    <p><strong>Estimasi Peserta:</strong> {{ $proposal->estimasi_peserta }}</p>
    <p><strong>Kebutuhan Logistik:</strong> {{ $proposal->kebutuhan_logistik }}</p>
    <p><strong>Tanggal Acara:</strong> {{ $proposal->tanggal_acara }}</p>
    <p><strong>Waktu Acara:</strong> {{ $proposal->waktu_acara }}</p>
    <p><strong>Detail Acara:</strong> {{ $proposal->detail_acara }}</p>
    <p><strong>Tanggal Pengajuan:</strong> {{ $proposal->tanggal_pengajuan }}</p>  
    <hr>
    @if($proposal->status_proposal === 'Disetujui' && $proposal->persetujuans)
        <h3>Rundown Acara</h3>
        @if ($proposal->rundowns->count())
            <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px; width: 100%;">
                <thead>
                    <tr>
                        <th>Judul Rundown</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->rundowns as $rundown)
                        <tr>
                            <td>{{ $rundown->judul_rundown }}</td>
                            <td>{{ $rundown->tanggal_kegiatan }}</td>
                            <td>
                                <a href="{{ route('rundowns.show', $rundown->id_rundown) }}">Lihat</a> |
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada rundown untuk acara ini.</p>
        @endif
        <hr>
        @if (session('error'))
            <div style="color: red; font-weight: bold;">    
                {{ session('error') }}
            </div>
            @endif
        @endif {{-- penutup utama untuk if status_proposal --}}
    
    <hr>
    <a href="{{ route('proposal.panitia.show', $proposal->id_proposal) }}">Kembali</a>
@endsection
