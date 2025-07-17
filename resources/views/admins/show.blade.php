<!-- resources/views/admins/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4 max-w-xl bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Profil Admin</h2>
    
    <div class="mb-4">
        <strong>Nama:</strong>
        <p>{{ $admin->nama_admin }}</p>
    </div>

    <div class="mb-4">
        <strong>Email:</strong>
        <p>{{ $admin->email }}</p>
    </div>

    <a href="{{ route('admins.edit', $admin->id_admin) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded">Edit Profil</a>
</div>
@endsection
