@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Profil Panitia</h2>

    <div class="mb-3">
        <strong>Nama:</strong>
        <p>{{ $panitia->nama_panitia }}</p>
    </div>

    <div class="mb-3">
        <strong>Email:</strong>
        <p>{{ $panitia->email }}</p>
    </div>

    <div class="mb-3">
        <strong>Jabatan:</strong>
        <p>{{ $panitia->jabatan_panitia }}</p>
    </div>

    @if($panitia->divisi)
    <div class="mb-3">
        <strong>Divisi:</strong>
        <p>{{ $panitia->divisi->nama_divisi }}</p>
    </div>
    @endif

    <div class="mb-3">
        <strong>Proposal / Acara:</strong>
        <p>{{ $panitia->proposal->nama_acara ?? '-' }}</p>
    </div>

    <div class="mt-5">
        <a href="{{ route('panitia.edit', $panitia->id_panitia) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded">Edit Profil</a>
    </div>
</div>
@endsection
