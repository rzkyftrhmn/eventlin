@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Admin</h1>
        </div>
    </div>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama Admin :</label>
                            <input class="form-control" type="text" name="nama_admin" value="{{ old('nama_admin') }}" required>
                            @error('nama_admin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email :</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password :</label>
                            <input class="form-control" type="password" name="password" value="{{ old('email') }}" required>
                            <small id="passwordHelp" style="display:block;color:gray;">
                                Minimal 8 karakter, termasuk huruf besar, huruf kecil, angka, dan simbol
                            </small>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password :</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-green">Simpan</button>
                        <a href="{{ route('admins.index') }}" class="btn btn-danger"> Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
