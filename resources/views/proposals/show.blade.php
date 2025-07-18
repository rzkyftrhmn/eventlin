
@extends('layouts.app')
@php
    $id_proposal = $proposal->id_proposal;
    // Route untuk kembali ke detail proposal
    if (auth('admin')->check()) {
        $routeTambahPanitia = route('panitia.create', $id_proposal);
        $routeShowPanitia = route('panitia.byProposal', $id_proposal); 
        $routeEditStatus =  $proposal->persetujuans 
                            ? route('persetujuans.editStatus', $proposal->persetujuans->id_persetujuan)
                            : null;
        $routeCreateRundown = route('rundowns.createRundown', $id_proposal);
    } elseif (auth('panitia')->check()) {
        $jabatan = strtolower(auth('panitia')->user()->jabatan_panitia);

        if (in_array($jabatan, ['ketua', 'sekretaris', 'bendahara', 'akademik'])) {
            $routeTambahPanitia = route('panitia.Supercreate', $id_proposal);
            $routeShowPanitia = route('panitia.SuperbyProposal', $id_proposal); 
            $routeEditStatus = $proposal->persetujuans 
                               ? route('persetujuans.SupereditStatus', $proposal->persetujuans->id_persetujuan)
                               : null;
            $routeCreateRundown = route('rundowns.SuperCreateRundown', $id_proposal);
        } else {
            $routeBack = route('proposal.panitia.show.read', ['id' => $id_proposal]);
            $routeTambahPanitia = route('panitia.create', $id_proposal);
        }
    } else {
        // default untuk debugging mode (misal akses publik)
        $routeBack = route('proposals.show', $id_proposal);
        $routeTambahPanitia = '#'; // atau nonaktifkan
    }
@endphp

@section('content')
    <!-- <h1>Detail Proposal</h1>

    <p><strong>Nama Acara:</strong> {{ $proposal->nama_acara }}</p>
    <p><strong>Jenis Acara:</strong> {{ $proposal->jenis_acara }}</p>
    <p><strong>Nama Pengusul:</strong> {{ $proposal->nama_pengusul }}</p>
    <p><strong>Judul Proposal:</strong> {{ $proposal->judul_proposal }}</p>
    <p><strong>Status:</strong> {{ $proposal->status_proposal }}</p>
    <p><strong>File Proposal:</strong> 
        @if($proposal->file_proposal)
           <a href="{{ asset($proposal->file_proposal) }}" target="_blank">Lihat File</a>
        @else
            Tidak ada file
        @endif
    </p>
    <p><strong>Estimasi Peserta:</strong> {{ $proposal->estimasi_peserta }}</p>
    <p><strong>Kebutuhan Logistik:</strong> {{ $proposal->kebutuhan_logistik }}</p>
    <p><strong>Tanggal Acara:</strong> {{ $proposal->tanggal_acara }}</p>
    <p><strong>Waktu Acara:</strong> {{ $proposal->waktu_acara }}</p>
    <p><strong>Detail Acara:</strong> {{ $proposal->detail_acara }}</p>
    <p><strong>Tangal pengajuan</strong> {{ $proposal->tanggal_pengajuan}}</p>  
    <hr>
    <h3>Panitia Acara</h3>
        <a href="{{$routeTambahPanitia}}">+ Tambah Panitia</a><br>
        <a href="{{$routeShowPanitia}}">Lihat Semua</a>
    @if($proposal->panitia->count() > 0)   
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposal->panitia->take(5) as $p)
                <tr>
                    <td>{{ $p->nama_panitia }}</td>
                    <td>{{ $p->jabatan_panitia }}</td>
                    <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada panitia untuk acara ini.</p>
    @endif
    @if($proposal->status_proposal === 'Disetujui' && $proposal->persetujuans)
        <hr>
        <h3>Informasi Persetujuan</h3>
        <p><strong>Pihak Penyetuju:</strong> {{ $proposal->persetujuans->pihak_penyetuju }}</p>
        <p><strong>Tanggal Persetujuan:</strong> {{ $proposal->persetujuans->tanggal_persetujuan }}</p>
        <p><strong>Status Persetujuan:</strong> {{ $proposal->persetujuans->status_persetujuan ?? 'Belum Ditentukan' }}</p>
        <p><a href="{{ $routeEditStatus }}">Ubah Status</a></p>
        <hr>
        <h3>Rundown Acara</h3>
        <a href="{{$routeCreateRundown}}">+ Tambah Rundown</a>
        @if ($proposal->rundowns->count())
            <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 10px; width: 100%;">
                <thead>
                    <tr>
                        <th>Judul Rundown</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->rundowns as $rundown)
                        <tr>
                            <td>{{ $rundown->judul_rundown }}</td>
                            <td>{{ $rundown->tanggal_kegiatan }}</td>
                            <td>
                                <a href="{{ route('rundowns.show', $rundown->id_rundown) }}">Lihat</a> |
                                <a href="{{ route('rundowns.edit', $rundown->id_rundown) }}">Edit</a> |
                                <form action="{{ route('rundowns.destroy', $rundown->id_rundown) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada rundown untuk acara ini.</p>
        @endif
        <hr
        @if ($proposal->kuotaPendaftaran)
            <hr>
            <h3>Kuota Pendaftaran</h3>
            <p><strong>Total Kuota:</strong> {{ $proposal->kuotaPendaftaran->total_kuota }}</p>
            <p><strong>Kuota Terpakai:</strong> {{ $proposal->kuotaPendaftaran->kuota_terpakai }}</p>
            <P><strong>Kuota Tersisa:</strong> {{ $proposal->kuotaPendaftaran->total_kuota - $proposal->kuotaPendaftaran->kuota_terpakai }}</p>
            <p><strong>Status Pendaftaran:</strong> {{ $proposal->kuotaPendaftaran->status_pendaftaran }}</p>
            <a href="{{ route('kuota.edit', $proposal->kuotaPendaftaran->id_kuota_pendaftaran) }}">Edit Kuota</a>
        @endif
        <hr>
     <h3>Peserta Acara</h3>
        <a href="{{ route('peserta.created', ['id_proposal' => $proposal->id_proposal]) }}">+ Tambah Peserta</a><br>
        <a href="{{ route('peserta.byProposal', ['id_proposal' => $proposal->id_proposal]) }}">Lihat Semua</a>
        @if (session('error'))
            <div style="color: red; font-weight: bold;">
                {{ session('error') }}
            </div>
        @endif
        @if($proposal->pesertas->count() > 0)
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 10px;">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->pesertas->take(5) as $peserta)
                        <tr>
                            <td>{{ $peserta->nim }}</td>
                            <td>{{ $peserta->nama_peserta }}</td>
                            <td>{{ $peserta->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada peserta yang mendaftar.</p>
        @endif

    @else
        <p>Status proposal: {{ $proposal->status_proposal }}</p>
        <p>Proposal ini belum disetujui.</p>
    @endif
    <hr>
    @if(auth('admin')->check())
    <hr>
    <h3>Pengaturan Divisi yang Boleh Melakukan Absensi</h3>
    <form action="{{ route('absensiDivisi.store', $proposal->id_proposal) }}" method="POST">
            @csrf
            <div>
                <p>Pilih Divisi yang bisa melakukan absensi panitia:</p>
                @foreach ($divisis as $divisi)
                    <label style="display: block; margin-bottom: 5px;">
                        <input type="checkbox" name="divisi_id[]" value="{{ $divisi->id_divisi }}"
                            {{ $proposal->divisiAbsensi->contains($divisi->id_divisi) ? 'checked' : '' }}>
                        {{ $divisi->nama_divisi }}
                    </label>
                @endforeach
            </div>
            <button type="submit">Simpan Akses Absensi</button>
        </form>
    @endif
    @if (auth('admin')->check())
        <a href="{{ route('proposals.index') }}">Kembali</a>
    @elseif (auth('panitia')->check() && in_array(auth('panitia')->user()->jabatan_panitia, ['ketua', 'sekretaris', 'bendahara']))
        <a href="{{ route('proposal.panitia.show') }}">Kembali ke Proposal Saya</a>
    @endif -->


    <div>
        <div class="page-header">
            <div>
                <h1 class="page-title">Detail Proposal</h1>
            </div>
        </div>
        
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
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
                                        <td>Status :</td>
                                        <td>{{ $proposal->status_proposal }}</td>
                                    </tr>
                                    <tr>
                                        <td>File Proposal :</td>
                                        <td>
                                            @if($proposal->file_proposal)
                                            <a href="{{ asset($proposal->file_proposal) }}" target="_blank">Lihat File</a>
                                            @else
                                                Tidak ada file
                                            @endif
                                        </td>
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
                                </tbody>
                            </table>
                        </div>
                        
                        <hr>

                        <div>
                            <h1 class="page-title mt-3 mb-4">Panitia Acara</h1>
                        </div>
                        <div class="ms-auto pageheader-btn">
                            <a href="{{$routeTambahPanitia}}" class="btn btn-primary btn-icon text-white me-2">
                                <span>
                                    <i class="fe fe-plus"></i>
                                </span> Add Panitia
                            </a>
                            <a href="{{$routeShowPanitia}}" class="btn btn-primary btn-icon text-white me-2">
                                 Lihat Semua
                            </a>
                        </div>
                        <div class="table-responsive mt-5">
                            @if($proposal->panitia->count() > 0)   
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proposal->panitia->take(5) as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_panitia }}</td>
                                        <td>{{ $p->jabatan_panitia }}</td>
                                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <p class="text-center">Belum ada panitia untuk acara ini.</p>
                            @endif
                        </div>

                        <hr>

                        @if($proposal->status_proposal === 'Disetujui' && $proposal->persetujuans)
                        <div>
                            <h1 class="page-title mt-3 mb-4">Informasi Persetujuan</h1>
                        </div>
                        <div class="ms-auto pageheader-btn">
                            <a href="{{ $routeEditStatus }}" class="btn btn-primary btn-icon text-white me-2">
                                Ubah Status
                            </a>
                        </div>
                        <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0 mt-5">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pihak Penyetuju</th>
                                    <th>Tanggal Persetujuan</th>
                                    <th>Status Persetujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $proposal->persetujuans->pihak_penyetuju }}</td>
                                    <td>{{ $proposal->persetujuans->tanggal_persetujuan }}</td>
                                    <td>{{ $proposal->persetujuans->status_persetujuan ?? 'Belum Ditentukan' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>

                        <div>
                            <h1 class="page-title mt-3 mb-4">Rundown Acara</h1>
                        </div>
                        <div class="ms-auto pageheader-btn mb-5">
                            <a href="{{$routeCreateRundown}}" class="btn btn-primary btn-icon text-white me-2">
                                Tambah Rundown
                            </a>
                        </div>
                        @if ($proposal->rundowns->count())
                            <div class="table-responsive mt-5">
                                <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
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
                                                    <a href="{{ route('rundowns.show', $rundown->id_rundown) }}" class="btn btn-info btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Lihat" style="height: 30px;"><i class="fe fe-eye" style="font-size: 16px;"></i></a>
                                                    <a href="{{ route('rundowns.edit', $rundown->id_rundown) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                    <form action="{{ route('rundowns.destroy', $rundown->id_rundown) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                            <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>    
                            @else
                                <p class="text-center">Belum ada rundown untuk acara ini.</p>
                            @endif

                            <hr>

                            @if ($proposal->kuotaPendaftaran)
                            <div class="page-header">
                                <div>
                                    <h1 class="page-title">Kuota Pendaftaran</h1>
                                </div>
                            </div>
                            <div class="ms-auto pageheader-btn">
                                <a href="{{ route('kuota.edit', $proposal->kuotaPendaftaran->id_kuota_pendaftaran) }}" class="btn btn-primary btn-icon text-white me-2">
                                    Lihat Semua
                                </a>
                            </div>
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0 mt-5">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Total Kuota</th>
                                        <th>Kuota Terpakai</th>
                                        <th>Kuota Tersisa</th>
                                        <th>Status Pendaftaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $proposal->kuotaPendaftaran->total_kuota }}</td>
                                        <td>{{ $proposal->kuotaPendaftaran->kuota_terpakai }}</td>
                                        <td>{{ $proposal->kuotaPendaftaran->total_kuota - $proposal->kuotaPendaftaran->kuota_terpakai }}</td>
                                        <td>{{ $proposal->kuotaPendaftaran->status_pendaftaran }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif

                            <div class="page-header">
                                <div>
                                    <h1 class="page-title">Peserta Acara</h1>
                                </div>
                            </div>
                            <div class="ms-auto pageheader-btn">
                                <a href="{{ route('peserta.created', ['id_proposal' => $proposal->id_proposal]) }}" class="btn btn-primary btn-icon text-white me-2">
                                    Add Peserta
                                </a>
                                <a href="{{ route('peserta.byProposal', ['id_proposal' => $proposal->id_proposal]) }}" class="btn btn-primary btn-icon text-white me-2">
                                    Lihat Semua
                                </a>
                            </div>
                            @if (session('error'))
                                <div style="color: red; font-weight: bold;">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="table-responsive mt-5">
                                @if($proposal->pesertas->count() > 0)   
                                <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proposal->pesertas->take(5) as $peserta)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $peserta->nim }}</td>
                                            <td>{{ $peserta->nama_peserta }}</td>
                                            <td>{{ $peserta->email }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <p class="text-center">Belum ada Peserta yang mendaftar</p>
                                @endif
                            </div>

                        @else
                            <p>Status proposal: {{ $proposal->status_proposal }}</p>
                            <p class="text-center">Proposal ini belum disetujui.</p>
                        @endif

                        <hr>

                        <form action="{{ route('absensiDivisi.store', $proposal->id_proposal) }}" method="POST">
                            @csrf
                            <h1 class="page-title">Pengaturan divisi</h1>
                            <p class="mt-1">Pilih Divisi yang bisa melakukan Absen Panitia :</p>
                            <div class="mb-3 mt-3">
                                @foreach ($divisis as $divisi)
                                    <label style="display: block;font-size: 15px;">
                                        <input type="radio" name="divisi_id" value="{{ $divisi->id_divisi }}"
                                            {{ $proposal->divisiAbsensi->contains($divisi->id_divisi) ? 'checked' : '' }}>
                                        {{ $divisi->nama_divisi }}
                                    </label>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Akses Absensi</button>
                            <button type="cancel" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                        </form>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-konfirmasi');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // hentikan submit default

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#1878FF',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush