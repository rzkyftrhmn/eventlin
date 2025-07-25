@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Admin</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
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
                        <div class="form-group">
                            <label class="form-label">Nama Admin :</label>
                            <input class="form-control" type="text" name="nama_admin" value="{{ $admin->nama_admin }}" required>
                            @error('nama_admin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email :</label>
                            <input class="form-control" type="text" name="email" value="{{ $admin->email }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password (opsional) :</label>
                            <input class="form-control" type="password" name="password">
                            <small>Biarkan kosong jika tidak ingin mengganti</small>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('admins.index') }}" class="btn btn-danger"> Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
