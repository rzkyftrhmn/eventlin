@extends('layouts.app')

@section('content')
    <h2>Dashboard Peserta</h2>
    <p>Selamat datang, {{ $peserta->nama_peserta }}!</p>
    <p>Terdaftar di Acara: {{ $peserta->proposal->nama_acara }}</p>
@endsection
