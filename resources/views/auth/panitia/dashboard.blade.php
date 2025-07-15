@extends('layouts.app')

@section('content')
    <h2>Halo {{ $user->nama_panitia }} ({{ $user->jabatan_panitia }})</h2>

    <form method="POST" action="{{ route('panitia.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    <h3>QR Code Absensi Anda</h3>
    {!! $qrCode !!}

    <hr>
    <a href="{{ route('proposal.panitia.show') }}">Lihat Proposal Saya</a>
@endsection
