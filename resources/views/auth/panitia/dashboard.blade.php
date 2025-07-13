@extends('layouts.app') {{-- Ganti sesuai layout utama kamu --}}

@section('content')
    <h2>Halo {{ $user->nama_panitia }} ({{ $user->jabatan_panitia }})</h2>

    <form method="POST" action="{{ route('panitia.logout') }}" style="margin-bottom: 15px;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <hr>
    <h3>Proposal Anda</h3>
    <a href="{{ route('proposal.panitia.show') }}">Lihat Proposal Saya</a>
@endsection
