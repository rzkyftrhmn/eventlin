@extends('layouts.app')

@section('content')
    <h1>Ubah Status Persetujuan</h1>
    <form action="
        @if(auth('admin')->check())
            {{ route('persetujuans.updateStatus', $persetujuan->id_persetujuan) }}
        @elseif(auth('panitia')->check() && in_array(strtolower(auth('panitia')->user()->jabatan_panitia), ['ketua', 'sekretaris', 'bendahara']))
            {{ route('persetujuans.SuperupdateStatus', $persetujuan->id_persetujuan) }}
        @else
            #
        @endif
    " 
    method="POST"
    >
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
