@extends('layouts.app')

@section('content')
<h2>Daftar Panitia - {{ $proposal->nama_acara }}</h2>

<a href="{{ route('panitia.create', $proposal->id_proposal) }}">+ Tambah Panitia</a>

@if($proposal->panitia->count())
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Divisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposal->panitia as $p)
            <tr>
                <td>{{ $p->nama_panitia }}</td>
                <td>{{ $p->jabatan_panitia }}</td>
                <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                <td>
                    <a href="{{ route('panitia.edit', $p->id_panitia) }}">Edit</a>
                    <form action="{{ route('panitia.destroy', $p->id_panitia) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus panitia ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Data panitia belum ada.</p>
@endif
@endsection
