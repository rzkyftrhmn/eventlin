@extends('layouts.app')

@section('content')
    <h1>Detail Divisi</h1>

    <p><strong>Nama Divisi:</strong> {{ $divisi->nama_divisi }}</p>
    <p><strong>List Tugas Divisi:</strong></p>
    <div style="white-space: pre-wrap;">{{ $divisi->list_tugas_divisi }}</div>

    <a href="{{ route('divisis.index') }}">Kembali ke daftar divisi</a>
@endsection
