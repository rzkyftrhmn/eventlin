@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Semua Panitia</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form class="filter-proposal-form" method="GET" action="{{ route('panitia.index') }}">
                        <input class="filter-proposal-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau jabatan">
                        <select class="filter-proposal-select" name="proposal">
                            <option value="">-- Semua Proposal --</option>
                            @foreach ($proposals as $p)
                                <option value="{{ $p->id_proposal }}" {{ request('proposal') == $p->id_proposal ? 'selected' : '' }}>
                                    {{ $p->nama_acara }}
                                </option>
                            @endforeach
                        </select>
                        <button class="filter-proposal-button" type="submit">Filter</button>
                    </form>

                    <div class="table-responsive mt-4">
                        @if($panitias->count())
                        <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                            <thead>
                                <tr>
                                    <td>No</td>
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_panitia }}</td>
                                        <td>{{ $p->jabatan_panitia }}</td>
                                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                                        <td>{{$p->email}}</td>
                                        <td>{{ $p->proposal->nama_acara ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            @if($panitias->hasPages())
                                {{ $panitias->links('vendor.pagination.custom') }}
                            @endif
                        @else
                            <p colspan="5" style="text-align: center;">Tidak ada Panitia ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
