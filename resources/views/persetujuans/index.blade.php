@extends('layouts.app')
@section('content')
    <h1>Daftar Proposal Menunggu Persetujuan</h1>

    <form action="{{ route('persetujuans.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Proposal...">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellpadding="10">
        <tr>
            <th>Nama Acara</th>
            <th>Judul Proposal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach ($proposals as $proposal)
            <tr>
                <td>{{ $proposal->nama_acara }}</td>
                <td>{{ $proposal->judul_proposal }}</td>
                <td>{{ $proposal->status_proposal }}</td>
                <td>
                    <a href="{{ route('proposals.show', $proposal->id_proposal) }}">Lihat Detail</a> |
                    <a href="{{ route('persetujuans.edit', $proposal->id_proposal) }}">Edit Status</a> 
                </td>
            </tr>
        @endforeach
    </table>

    <div style="margin-top: 20px;">
        {{ $proposals->links() }}
    </div>
@endsection
