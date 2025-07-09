@extends('layouts.app')

@section('content')
    <h1>Detail Proposal</h1>

    <p><strong>Nama Acara:</strong> {{ $proposal->nama_acara }}</p>
    <p><strong>Jenis Acara:</strong> {{ $proposal->jenis_acara }}</p>
    <p><strong>Nama Pengusul:</strong> {{ $proposal->nama_pengusul }}</p>
    <p><strong>Judul Proposal:</strong> {{ $proposal->judul_proposal }}</p>
    <p><strong>Status:</strong> {{ $proposal->status_proposal }}</p>
    <p><strong>File Proposal:</strong> 
        @if($proposal->file_proposal)
            <a href="{{ asset('proposals/' . $proposal->file_proposal) }}" target="_blank">Lihat File</a>
        @else
            Tidak ada file
        @endif
    </p>
    <p><strong>Estimasi Peserta:</strong> {{ $proposal->estimasi_peserta }}</p>
    <p><strong>Kebutuhan Logistik:</strong> {{ $proposal->kebutuhan_logistik }}</p>
    <p><strong>Tanggal Acara:</strong> {{ $proposal->tanggal_acara }}</p>
    <p><strong>Waktu Acara:</strong> {{ $proposal->waktu_acara }}</p>
    <p><strong>Detail Acara:</strong> {{ $proposal->detail_acara }}</p>
    @if($proposal->status_proposal === 'Disetujui' && $proposal->persetujuans)
        <hr>
        <h3>Informasi Persetujuan</h3>
        <p><strong>Pihak Penyetuju:</strong> {{ $proposal->persetujuans->pihak_penyetuju }}</p>
        <p><strong>Tanggal Persetujuan:</strong> {{ $proposal->persetujuans->tanggal_persetujuan }}</p>
        <p><strong>Status Persetujuan:</strong> {{ $proposal->persetujuans->status_persetujuan ?? 'Belum Ditentukan' }}</p>
        <p><a href="{{ route('persetujuans.editStatus', $proposal->persetujuans->id_persetujuan) }}">Ubah Status</a></p>
        <hr>
        <h3>Rundown Acara</h3>
        <a href="{{ route('rundowns.createRundown', ['id_proposal' => $proposal->id_proposal]) }}">+ Tambah Rundown</a>
        @if ($proposal->rundowns->count())
            <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px; width: 100%;">
                <thead>
                    <tr>
                        <th>Judul Rundown</th>
                        <th>Tanggal Kegiatan</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->rundowns as $rundown)
                        <tr>
                            <td>{{ $rundown->judul_rundown }}</td>
                            <td>{{ $rundown->tanggal_kegiatan }}</td>
                            <td>
                                <a href="{{ route('rundowns.show', $rundown->id_rundown) }}">Lihat</a> |
                                <a href="{{ route('rundowns.edit', $rundown->id_rundown) }}">Edit</a> |
                                <form action="{{ route('rundowns.destroy', $rundown->id_rundown) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada rundown untuk acara ini.</p>
        @endif
    @endif
    <hr>
    <a href="{{ route('proposals.index') }}">Kembali</a>
@endsection
