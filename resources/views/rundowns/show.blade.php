@extends('layouts.app')

@section('content')
    <h2>Detail Rundown</h2>

    <p><strong>Judul Rundown:</strong> {{ $rundown->judul_rundown }}</p>
    <p><strong>Tanggal Kegiatan:</strong> {{ $rundown->tanggal_kegiatan }}</p>
    <p><strong>Nama Acara:</strong> {{ $rundown->proposal->nama_acara ?? '-' }}</p>

    <a href="{{ route('proposals.show', $rundown->id_proposal) }}">Kembali ke Detail Proposal</a>
    <hr>
    <h3>Detail Rundown</h3>

    <a href="{{ route('detail-rundowns.create', ['id_rundown' => $rundown->id_rundown]) }}">+ Tambah Detail Rundown</a>

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; margin-top: 15px;">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Jam Awal</th>
                <th>Jam Akhir</th>
                <th>Detail Acara</th>
                <th>Divisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rundown->detailRundowns as $detail)
                <tr>
                    <td>{{ $detail->judul_rundown }}</td>
                    <td>{{ $detail->jam_awal }}</td>
                    <td>{{ $detail->jam_akhir }}</td>
                    <td>{{ $detail->detail_kegiatan }}</td>
                    <td>{{ $detail->divisi->nama_divisi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('detail-rundowns.edit', $detail->id_detail_rundown) }}">Edit</a> |
                        <form action="{{ route('detail-rundowns.destroy', $detail->id_detail_rundown) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center;">Belum ada detail rundown.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
