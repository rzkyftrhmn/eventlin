@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Semua Peserta</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="GET" action="{{ route('peserta.index') }}" class="filter-proposal-form" style="margin-bottom: 15px;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email" class="filter-proposal-input">
                        <select name="proposal" class="filter-proposal-select">
                            <option value="">-- Semua Proposal --</option>
                            @foreach ($proposals as $p)
                                <option value="{{ $p->id_proposal }}" {{ request('proposal') == $p->id_proposal ? 'selected' : '' }}>
                                    {{ $p->nama_acara }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="filter-proposal-button">Filter</button>
                    </form>

                    @if($pesertas->count())
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
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
                                            <td>{{ ($pesertas->currentPage() - 1) * $pesertas->perPage() + $loop->iteration }}</td>
                                            <td>{{ $peserta->nim }}</td>
                                            <td>{{ $peserta->nama_peserta }}</td>
                                            <td>{{ $peserta->email }}</td>
                                            <td>{{ $peserta->tanggal_pendaftaran }}</td>
                                            <td>{{ $peserta->proposal->nama_acara ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination --}}
                        @if($pesertas->hasPages())
                            {{ $pesertas->links('vendor.pagination.custom') }}
                        @endif
                    @else
                        <p colspan="5" style="text-align: center;">Tidak ada peserta ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection
