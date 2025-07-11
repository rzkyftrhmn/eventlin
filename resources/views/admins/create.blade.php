@extends('layouts.app')

@section('content')
    <h1>Tambah Admin</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admins.store') }}" method="POST">
        @csrf

        <div>
            <label for="nama_admin">Nama Admin</label>
            <input type="text" name="nama_admin" value="{{ old('nama_admin') }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <small id="passwordHelp" style="display:block;color:gray;">
                Minimal 8 karakter, termasuk huruf besar, huruf kecil, angka, dan simbol
            </small>
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <small id="matchMessage" style="display:block;"></small>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <script>
        // Password match checker
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const matchMessage = document.getElementById('matchMessage');

        confirm.addEventListener('input', () => {
            if (confirm.value !== password.value) {
                matchMessage.textContent = 'Password tidak cocok!';
                matchMessage.style.color = 'red';
            } else {
                matchMessage.textContent = 'Password cocok.';
                matchMessage.style.color = 'green';
            }
        });
    </script>
@endsection
