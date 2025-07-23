@extends('layouts.app')

@section('content')
    <h2>Halo {{ $user->nama_panitia }} ({{ $user->jabatan_panitia }})</h2>
    <hr>

    <h3>QR Code Absensi Anda</h3>
    {!! $qrCode !!}

    <hr>
@endsection
