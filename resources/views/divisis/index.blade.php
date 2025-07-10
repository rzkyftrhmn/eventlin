@extends('layouts.app')

@section('content')
    <h2>Daftar Divisi</h2>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('divisis.create') }}">+ Tambah Divisi</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama Divisi</th>
            <th>Aksi</th>
        </tr>
        @foreach($divisis as $divisi)
        <tr>
            <td>{{ $divisi->nama_divisi }}</td>
            <td>
                <a href="{{ route('divisis.edit', $divisi->id_divisi) }}">Edit</a> |
                <a href="{{ route('divisis.show', $divisi->id_divisi) }}">Detail</a> |
                <form action="{{ route('divisis.destroy', $divisi->id_divisi) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $divisis->links() }}
@endsection
