@extends('layouts.app')

@section('content')
    <h2>Edit Admin</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admins.update', $admin->id_admin) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nama:</label>
            <input type="text" name="nama_admin" value="{{ $admin->nama_admin }}" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $admin->email }}" required>
        </div>
        <div>
            <label>Password (opsional):</label>
            <input type="password" name="password">
            <small>Biarkan kosong jika tidak ingin mengganti</small>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
