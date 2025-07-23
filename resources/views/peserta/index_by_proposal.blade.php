@extends('layouts.app')

@section('content')
    <h1>Daftar Peserta untuk {{ $proposal->nama_acara }}</h1>

    <form method="GET" action="{{ route('peserta.byProposal', $proposal->id_proposal) }}">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari peserta...">
        <button type="submit">Cari</button>
    </form>
    
    <a href="{{ route('peserta.created', ['id_proposal' => $proposal->id_proposal]) }}">+ Tambah Peserta</a>
    @if ($pesertas->count())
        <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px; width: 100%;">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesertas as $peserta)
                    <tr>
                        <td>{{ $peserta->nim }}</td>
                        <td>{{ $peserta->nama_peserta }}</td>
                        <td>{{ $peserta->email }}</td>
                        <td>
                            <a href="{{ route('peserta.edit', $peserta->nim) }}">Edit</a> |
                            <form action="{{ route('peserta.destroy', $peserta->nim) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin?')" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pesertas->links() }}
    @else
        <p>Tidak ada peserta terdaftar.</p>
    @endif
     @php
        $id_proposal = $proposal->id_proposal;
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
@endsection
