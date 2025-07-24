@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Proposal</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card costum-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Nama Acara :</td>
                                    <td>{{ $proposal->nama_acara }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Acara :</td>
                                    <td>{{ $proposal->jenis_acara }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pengusul :</td>
                                    <td>{{ $proposal->nama_pengusul }}</td>
                                </tr>
                                <tr>
                                    <td>Judul Proposal :</td>
                                    <td>{{ $proposal->judul_proposal }}</td>
                                </tr>
                                <tr>
                                    <td>Estimasi Peserta :</td>
                                    <td>{{ $proposal->estimasi_peserta }}</td>
                                </tr>
                                <tr>
                                    <td>Kebutuhan Logistik :</td>
                                    <td>{{ $proposal->kebutuhan_logistik }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Acara :</td>
                                    <td>{{ $proposal->tanggal_acara }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Acara :</td>
                                    <td>{{ $proposal->waktu_acara }}</td>
                                </tr>
                                <tr>
                                    <td>Detail Acara :</td>
                                    <td>{{ $proposal->detail_acara }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengajuan :</td>
                                    <td>{{ $proposal->tanggal_pengajuan }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Acara :</td>
                                    <td>{{ $proposal->is_berbayar ? 'Berbayar' : 'Gratis' }}</td>
                                </tr>
                                @if ($proposal->is_berbayar)
                                    <tr>
                                        <td>Harga Tiket :</td>
                                        <td>{{ $proposal->harga_tiket }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Bank :</td>
                                        <td>{{ $proposal->nama_bank }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening :</td>
                                        <td>{{ $proposal->nomor_rekening }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pemilik Rekening :</td>
                                        <td>{{ $proposal->nama_pemilik_rekening }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($proposal->status_proposal === 'Disetujui' && $proposal->persetujuans)
        @php
            $user = auth('panitia')->user();
            $divisiPanitia = $user->id_divisi ?? null;
            $divisiBolehAbsen = \App\Models\AbsensiAksesDivisi::where('id_proposal', $proposal->id_proposal)
                                    ->pluck('id_divisi')
                                    ->toArray();
        @endphp

        <div class="page-header">
            <div>
                <h1 class="page-title">Rundown Acara</h1>
            </div>
        </div>

        @if (session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div style="color: red; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card costum-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($proposal->rundowns->count())
                                <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Rundown</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proposal->rundowns as $rundown)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rundown->judul_rundown }}</td>
                                                <td>{{ $rundown->tanggal_kegiatan }}</td>
                                                <td>
                                                    <a href="{{ route('rundowns.panitia.show', $rundown->id_rundown) }}" class="btn btn-info btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Lihat" style="height: 30px;"><i class="fe fe-eye" style="font-size: 16px;"></i></a>
                                                    @if(in_array($divisiPanitia, $divisiBolehAbsen))
                                                    <a href="{{ route('absensi.rekap', $rundown->id_rundown) }}" class="btn btn-primary">Mulai Absensi</a>
                                                    @else
                                                        
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Belum ada rundown untuk acara ini.</p>
                            @endif
                        </div>        
                    </div>        
                </div>        
            </div>        
        </div>        
        
        @if (session('error'))
            <div style="color: red; font-weight: bold;">    
                {{ session('error') }}
            </div>
        @endif
    @endif
    <a href="{{ route('proposal.panitia.show', $proposal->id_proposal) }}" class="btn btn-primary mb-4">Kembali</a>
@endsection
