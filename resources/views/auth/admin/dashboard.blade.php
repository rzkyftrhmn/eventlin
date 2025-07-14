@extends('layouts.app')

@section('content')
    <h2>Halo, Admin {{ $user->nama_admin }}</h2>

    <p>Selamat datang di halaman dashboard admin. Silakan kelola data proposal, panitia, peserta, dan lainnya.</p>

    {{-- Link ke halaman semua proposal --}}
    <p>
        <a href="{{ route('proposals.index') }}">📋 Lihat Semua Proposal</a>
    </p>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
