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
    <p><strong>Jenis Acara:</strong> {{ $proposal->is_berbayar ? 'Berbayar' : 'Gratis' }}</p>
    @if ($proposal->is_berbayar)
        <p><strong>Harga Tiket:</strong> {{ $proposal->harga_tiket }}</p>
        <p><strong>Nama Bank:</strong> {{ $proposal->nama_bank }}</p>
        <p><strong>Nomor Rekening:</strong> {{ $proposal->nomor_rekening }}</p>
        <p><strong>Nama Pemilik Rekening:</strong> {{ $proposal->nama_pemilik_rekening }}</p>
    @endif    
    <hr>
    @if($proposal->status_proposal === 'Disetujui' && $proposal->persetujuans)
        @php
            $user = auth('panitia')->user();
            $divisiPanitia = $user->id_divisi ?? null;
            $divisiBolehAbsen = \App\Models\AbsensiAksesDivisi::where('id_proposal', $proposal->id_proposal)
                                    ->pluck('id_divisi')
                                    ->toArray();
        @endphp
        <h3>Rundown Acara</h3>
        @if (session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div style="color: red; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

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
                                <a href="{{ route('rundowns.panitia.show', $rundown->id_rundown) }}">Lihat</a> |
                                @if(in_array($divisiPanitia, $divisiBolehAbsen))
                                    <a href="{{ route('absensi.rekap', $rundown->id_rundown) }}" class="btn btn-primary">Mulai Absensi</a>
                                @else
                                    
                                @endif
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
