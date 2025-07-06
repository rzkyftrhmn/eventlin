@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Data Proposal</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    
    <a href="{{ route('proposals.create') }}">Tambah Proposal</a>
    <h1>PROPOSAL</h1>
    @if($proposals->isEmpty())
        <p>Belum ada proposal.</p>
    @else
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Nama Acara</th>
                    <th>Jenis Acara</th>
                    <th>Status</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                <tr>
                    <td>{{ $proposal->nama_acara }}</td>
                    <td>{{ $proposal->jenis_acara }}</td>
                    <td>{{ $proposal->status_proposal }}</td>
                    <td>
                        <a href="{{ asset($proposal->file_proposal) }}" target="_blank">Lihat File</a>
                    </td>
                    <td>
                        <a href="{{ route('proposals.edit', $proposal->id_proposal) }}">Edit</a>
                        <form action="{{ route('proposals.destroy', $proposal->id_proposal) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
