@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Proposal Saya</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if ($proposal)
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>Nama Acara</th>
                                        <th>Judul Proposal</th>
                                        <th>Status</th>
                                        <th>File Proposal</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $proposal->nama_acara }}</td>
                                        <td>{{ $proposal->judul_proposal }}</td>
                                        <td>
                                            @if ($proposal->status_proposal === 'Disetujui')
                                                <span style="color: green;">Disetujui</span>
                                            @elseif ($proposal->status_proposal === 'Ditolak')
                                                <span style="color: red;">Ditolak</span>
                                            @else
                                                <span style="color: gray;">Diajukan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($proposal->file_proposal)
                                                <a href="{{ asset($proposal->file_proposal) }}" target="_blank" class="btn btn-info btn-sm rounded-11" data-bs-toggle="tooltip" data-bs-original-title="Lihat File" style="height: 30px;"><i class="fe fe-file" style="font-size: 16px; color: white;"></i></a>
                                            @else
                                                <span>Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch(strtolower(auth('panitia')->user()->jabatan_panitia))
                                                @case('ketua')
                                                @case('sekretaris')
                                                @case('bendahara')
                                                    <a href="{{ route('proposal.superpanitia.show', $proposal->id_proposal) }}" class="btn btn-info btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail" style="height: 30px;"><i class="fe fe-eye" style="font-size: 16px;"></i></a>
                                                    @break
                                                @case('panitia')
                                                    <a href="{{ route('proposal.panitia.show.read', $proposal->id_proposal) }}" class="btn btn-info btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail" style="height: 30px;"><i class="fe fe-eye" style="font-size: 16px;"></i></a>
                                                    @break
                                                @default
                                                    <span style="color: red;">Akses ditolak</span>
                                            @endswitch

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Tidak ada proposal yang dapat ditampilkan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

   
    <hr>
@endsection
