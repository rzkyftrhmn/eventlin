@extends('layouts.app')

@section('content')
    <h1>Ubah Status Persetujuan</h1>
    <form action="{{ route('persetujuans.updateStatus', $persetujuan->id_persetujuan) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nama Acara:</label>
            <strong>{{ $persetujuan->proposal->nama_acara ?? '-' }}</strong>
        </div>

        <div>
            <label>Status Persetujuan:</label>
            <select name="status_persetujuan" required>
                <option value="">-- Pilih Status --</option>
                <option value="Disetujui" {{ $persetujuan->status_persetujuan === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="Ditolak" {{ $persetujuan->status_persetujuan === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection
