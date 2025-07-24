<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav style="background-color: #f0f0f0; padding: 10px; margin-bottom: 20px;">
        @auth('admin')
            {{-- Admin Links --}}
            <a href="{{ route('admin.dashboard')}}" style="margin-right: 10px;">Dashboard</a>
            <a href="{{ route('proposals.index') }}" style="margin-right: 10px;">Proposal</a>
            <a href="{{ route('admins.index') }}" style="margin-right: 10px;">Admin</a>
            <a href="{{ route('panitia.index') }}" style="margin-right: 10px;">Panitia</a>
            <a href="{{ route('peserta.index') }}" style="margin-right: 10px;">Peserta</a>
            <a href="{{ route('divisis.index') }}" style="margin-right: 10px;">Divisi</a>
                <a href="{{ route('admins.show', auth('admin')->user()->id_admin) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
            {{-- Logout Admin --}}
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="color: red; float: right; background: none; border: none; cursor: pointer;">Logout (Admin)</button>
            </form>
        @endauth

        @auth('panitia')
            {{-- Panitia Links (tampilkan sesuai kebutuhan) --}}
            <a href="{{ route('panitia.dashboard')}}" style="margin-right: 10px;">Dashboard</a>
            <a href="{{ route('proposal.panitia.show') }}">Proposal</a>
            {{-- Logout Panitia --}}
            <a href="{{ route('panitia.profile', auth('panitia')->user()->id_panitia) }}" style="margin-right: 10px;">
                Profil Saya
            </a>
            <form action="{{ route('panitia.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="color: red; float: right; background: none; border: none; cursor: pointer;">Logout (Panitia)</button>
            </form>
        @endauth

        @auth('peserta')
            {{-- Peserta Links (tampilkan sesuai kebutuhan) --}}
            <a href="{{ route('peserta.dashboard')}}" style="margin-right: 10px;">Dashboard</a>
            <a href="{{ route('peserta.profile', auth('peserta')->user()->nim) }}" style="margin-right: 10px;">
                Profil Saya
            </a>
            @php
            $peserta = Auth::user();
            @endphp
            
            @if ($peserta->proposal->is_berbayar)
                <a href="{{route('pembayaran.konfirmasi',$peserta->nim)}}">Pembayaran</a>
            @endif
            {{-- Logout Peserta --}}
            <form action="{{ route('peserta.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="color: red; float: right; background: none; border: none; cursor: pointer;">Logout (Peserta)</button>
            </form>
        @endauth

    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
