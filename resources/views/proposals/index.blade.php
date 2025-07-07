@extends('layouts.app')

@section('content')
    <h1>Daftar Proposal</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('proposals.search') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Cari Proposal..." value="{{ request('keyword') }}" required>
        <button type="submit">Cari</button>
        <a href="{{ route('proposals.index') }}" style="margin-left: 10px;">Reset</a>
    </form>

    <a href="{{ route('proposals.create') }}" style="margin-bottom: 15px; display: inline-block;">Tambah Proposal</a>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Nama Acara</th>
                <th>Judul Proposal</th>
                <th>Status</th>
                <th>File Proposal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proposals as $proposal)
                <tr>
                    <td>{{ $proposal->nama_acara }}</td>
                    <td>{{ $proposal->judul_proposal }}</td>
                    <td>{{ $proposal->status_proposal }}</td>
                    <td><a href="{{ asset('proposals/' . $proposal->file_proposal) }}" target="_blank">Lihat</a></td>
                    <td>
                        <a href="{{ route('proposals.show', $proposal->id_proposal) }}">Detail</a> |
                        <a href="{{ route('proposals.edit', $proposal->id_proposal) }}">Edit</a> |
                        <form action="{{ route('proposals.destroy', $proposal->id_proposal) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $proposals->links() }}
    </div>
@endsection
