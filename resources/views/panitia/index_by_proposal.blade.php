@extends('layouts.app')

@section('content')
    <h2>Daftar Panitia untuk {{ $proposal->nama_acara }}</h2>

    <form method="GET" action="{{ route('panitia.byProposal', $proposal->id_proposal) }}">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau jabatan...">
        <button type="submit">Cari</button>
    </form>

    <a href="{{ route('panitia.create', $proposal->id_proposal) }}">+ Tambah Panitia</a><br><br>

    @if ($panitias->count())
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panitias as $p)
                    <tr>
                        <td>{{ $p->nama_panitia }}</td>
                        <td>{{ $p->jabatan_panitia }}</td>
                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                        <td>
                            <a href="{{ route('panitia.edit', $p->id_panitia) }}">Edit</a>
                            <form action="{{ route('panitia.destroy', $p->id_panitia) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin?')" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $panitias->links() }}
    @else
        <p>Belum ada panitia untuk acara ini.</p>
    @endif

    <a href="{{ route('proposals.show', $proposal->id_proposal) }}">⬅ Kembali ke Proposal</a>
@endsection
