@extends('layouts.app')

@section('content')
    <h1>Proposal Saya</h1>

    @if ($proposal)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
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
                            <a href="{{ asset($proposal->file_proposal) }}" target="_blank">Lihat File</a>
                        @else
                            <span>Tidak ada file</span>
                        @endif
                    </td>
                    <td>
                        @switch(strtolower(auth('panitia')->user()->jabatan_panitia))
                            @case('ketua')
                            @case('sekretaris')
                            @case('bendahara')
                                <a href="{{ route('proposal.superpanitia.show', $proposal->id_proposal) }}">Lihat Detail</a>
                                @break
                            @case('panitia')
                                <a href="{{ route('proposal.panitia.show.read', $proposal->id_proposal) }}">Lihat (Read-Only)</a>
                                @break
                            @default
                                <span style="color: red;">Akses ditolak</span>
                        @endswitch

                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Tidak ada proposal yang dapat ditampilkan.</p>
    @endif
    <hr>
@endsection
