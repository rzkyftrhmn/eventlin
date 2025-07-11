@extends('layouts.app')

@section('content')
    <h1>Manajemen Admin</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admins.create') }}">+ Tambah Admin</a>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admin->nama_admin }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('admins.edit', $admin->id_admin) }}">Edit</a> |
                        <form action="{{ route('admins.destroy', $admin->id_admin) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus admin ini?')" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" style="text-align: center;">Belum ada data admin</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
