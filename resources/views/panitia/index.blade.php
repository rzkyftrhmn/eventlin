@extends('layouts.app')

@section('content')
    <h2>Semua Panitia</h2>

    <form method="GET" action="{{ route('panitia.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau jabatan">
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

    @if($panitias->count())
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>email</th>
                    <th>Proposal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($panitias as $p)
                    <tr>
                        <td>{{ $p->nama_panitia }}</td>
                        <td>{{ $p->jabatan_panitia }}</td>
                        <td>{{$p->email}}</td>
                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $p->proposal->nama_acara ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        @if($panitias->hasPages())
            <div style="margin-top: 15px;">
                {{ $panitias->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <p>Tidak ada panitia ditemukan.</p>
    @endif
@endsection
