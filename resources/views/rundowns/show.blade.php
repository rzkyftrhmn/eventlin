@extends('layouts.app')

@section('content')
    <h2>Detail Rundown</h2>

    <p><strong>Judul Rundown:</strong> {{ $rundown->judul_rundown }}</p>
    <p><strong>Tanggal Kegiatan:</strong> {{ $rundown->tanggal_kegiatan }}</p>
    <p><strong>Nama Acara:</strong> {{ $rundown->proposal->nama_acara ?? '-' }}</p>

    @php
        $id_proposal = $rundown->id_proposal;
    @endphp

    @if(auth()->guard('admin')->check())
        <a href="{{ route('proposals.show', $id_proposal) }}">Kembali ke Detail Proposal</a>
    @elseif(auth()->guard('panitia')->check())
        @php
            $jabatan = strtolower(auth('panitia')->user()->jabatan_panitia);
        @endphp

        @if(in_array($jabatan, ['ketua', 'sekretaris', 'bendahara']))
            <a href="{{ route('proposal.superpanitia.show', $id_proposal) }}">Kembali ke Detail Proposal</a>
        @else
            <a href="{{ route('proposal.panitia.show.read', ['id' => $id_proposal]) }}">Kembali ke Detail Proposal</a>
        @endif
    @endif

    
    <hr>
    <h3>Detail Rundown</h3>
    {{-- Tampilkan tombol tambah hanya untuk admin dan panitia super --}}
    @if(auth('admin')->check() || (auth('panitia')->check() && in_array(auth('panitia')->user()->jabatan_panitia, ['ketua', 'sekretaris', 'bendahara'])))
        <a href="{{ route('detail-rundowns.create', ['id_rundown' => $rundown->id_rundown]) }}">+ Tambah Detail Rundown</a>
    @endif
    
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
                    {{-- <td>
                        @if(auth('admin')->check() || (auth('panitia')->check() && in_array(auth('panitia')->user()->jabatan_panitia, ['Ketua', 'Sekretaris', 'Bendahara'])))
                            <a href="{{ route('detail-rundowns.edit', $detail->id_detail_rundown) }}">Edit</a> |
                            <form action="{{ route('detail-rundowns.destroy', $detail->id_detail_rundown) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        @else
                            <span style="color: #888;">Read Only</span>
                        @endif
                    </td> --}}
                    <td>
                         @if(!auth('panitia')->check() || !in_array(auth('panitia')->user()->jabatan_panitia, ['panitia']))
                            <a href="{{ route('detail-rundowns.edit', $detail->id_detail_rundown) }}">Edit</a> |
                            <form action="{{ route('detail-rundowns.destroy', $detail->id_detail_rundown) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        @else
                            <span style="color: #888;">Read Only</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center;">Belum ada detail rundown.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
