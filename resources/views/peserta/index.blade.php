@extends('layouts.app')

@section('content')
    <h2>Semua Peserta</h2>

    <form method="GET" action="{{ route('peserta.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email">
        <select name="proposal">
            <option value="">-- Semua Proposal --</option>
            @foreach ($proposals as $p)
                <option value="{{ $p->id_proposal }}" {{ request('proposal') == $p->id_proposal ? 'selected' : '' }}>
                    {{ $p->nama_acara }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    @if($pesertas->count())
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Proposal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertas as $peserta)
                    <tr>
                        <td>{{ $peserta->nim }}</td>
                        <td>{{ $peserta->nama_peserta }}</td>
                        <td>{{ $peserta->email }}</td>
                        <td>{{ $peserta->tanggal_pendaftaran }}</td>
                        <td>{{ $peserta->proposal->nama_acara ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        @if($pesertas->hasPages())
            <div style="margin-top: 15px;">
                {{ $pesertas->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <p>Tidak ada peserta ditemukan.</p>
    @endif
@endsection
