@extends('layouts.app')
@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Proposal Menunggu Persetujuan</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form class="filter-proposal-form" method="GET" action="{{ route('persetujuans.index') }}">
                        <input class="filter-proposal-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari Proposal...">
                        <button class="filter-proposal-button" type="submit">Search</button>
                    </form>
                    <div class="table-responsive mt-4">
                        <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                            <tr>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Judul Proposal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                            @foreach ($proposals as $proposal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $proposal->nama_acara }}</td>
                                    <td>{{ $proposal->judul_proposal }}</td>
                                    <td>{{ $proposal->status_proposal }}</td>
                                    <td>
                                        <a href="{{ route('proposal.superpanitia.show', $proposal->id_proposal) }}" class="btn btn-info btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Lihat" style="height: 30px;"><i class="fe fe-eye" style="font-size: 16px;"></i></a>
                                        <a href="{{ route('persetujuans.editAkademik', $proposal->id_proposal) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $proposals->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
