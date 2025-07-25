@extends('layouts.app')

@section('content')
<style>
    .input-keterangan {
        padding: 8px 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        height: 38px;
    }

    .input-keterangan::placeholder {
        color: #6c757d;
    }

    .input-keterangan:focus {
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }
</style>
    <div class="page-header">
        <div>
            <h1 class="page-title mb-3">Rekap Absensi Panitia - {{ $rundown->judul_rundown }}</h1>
            <p><strong>Tanggal Kegiatan:</strong> {{ $rundown->tanggal_kegiatan }}</p>
        </div>
    </div>

     <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if (session('success'))
                        <div style="color: green;">{{ session('success') }}</div>
                    @endif
                    @if (session('error')) 
                        <div style="color: red;">{{ session('error') }}</div>
                    @endif  
                    
                    <form method="GET">
                        <input class="filter-proposal-input" type="text" name="search" placeholder="Cari nama/email..." value="{{ request('search') }}">
                        <select class="filter-proposal-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Tidak Hadir" {{ request('status') == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                            <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Terlambat" {{ request('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Filter</button>
                        <a class="btn btn-primary" href="{{ route('absensi.scan', $rundown->id_rundown) }}">🔍 Scan QR</a>
                    </form>
                    
                    <div class="table-responsive mt-4">
                        <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>Status Kehadiran</th>
                                <th>Keterangan</th>
                                <th>Isi Manual</th>
                            </tr>
                            @foreach($panitias as $panitia)
                                <tr>
                                    <td>{{ $panitia->nama_panitia }}</td>
                                    <td>{{ $panitia->jabatan_panitia }}</td>
                                    <td>{{ $panitia->divisi->nama_divisi ?? '-' }}</td>
                                    <td>{{ $panitia->absensi->last()->status_kehadiran ?? 'Belum Absen' }}</td>
                                    <td>{{ $panitia->absensi->last()->keterangan ?? '-' }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('absensi.manual') }}">
                                            @csrf
                                            <input type="hidden" name="id_panitia" value="{{ $panitia->id_panitia }}">
                                            <input type="hidden" name="id_rundown" value="{{ $rundown->id_rundown }}">
                                            @php
                                                $selected = old('status_kehadiran', $panitia->absensi->last()?->status_kehadiran?? '');
                                            @endphp
                                            <select class="filter-proposal-select" name="status_kehadiran" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Hadir" {{ $selected == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                                <option value="Tidak Hadir" {{ $selected == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                                <option value="Izin" {{ $selected == 'Izin' ? 'selected' : '' }}>Izin</option>
                                                <option value="Terlambat" {{ $selected == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                            </select>
                                            <input class="input-keterangan" type="text" name="keterangan" placeholder="Keterangan...">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $panitias->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection