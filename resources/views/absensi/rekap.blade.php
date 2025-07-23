@extends('layouts.app')

@section('content')
    <h2>Rekap Absensi Panitia - {{ $rundown->judul_rundown }}</h2>
    <p><strong>Tanggal Kegiatan:</strong> {{ $rundown->tanggal_kegiatan }}</p>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if (session('error')) 
        <div style="color: red;">{{ session('error') }}</div>
    @endif  
    
    <form method="GET">
        <input type="text" name="search" placeholder="Cari nama/email..." value="{{ request('search') }}">
        <select name="status">
            <option value="">Semua Status</option>
            <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="Tidak Hadir" {{ request('status') == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
            <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
            <option value="Terlambat" {{ request('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>
        <button type="submit">Filter</button>
        <br>
        <a href="{{ route('absensi.scan', $rundown->id_rundown) }}">🔍 Scan QR</a>
    </form>
    <table border="1" cellpadding="6" style="margin-top: 15px;">
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
                        <select name="status_kehadiran" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir" {{ $selected == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Tidak Hadir" {{ $selected == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                            <option value="Izin" {{ $selected == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Terlambat" {{ $selected == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                        <input type="text" name="keterangan" placeholder="Keterangan...">
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $panitias->links() }}
@endsection
