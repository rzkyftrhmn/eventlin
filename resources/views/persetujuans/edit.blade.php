@extends('layouts.app')

@section('content')
    <h1>Edit Status Proposal</h1>

    <form action="{{ route('persetujuans.updateAkademik', $proposal->id_proposal) }}" method="POST">
        @csrf
        @method('PUT')

        <p>Nama Acara: {{ $proposal->nama_acara }}</p>
        <p>Judul Proposal: {{ $proposal->judul_proposal }}</p>

        <label for="status_proposal">Status Proposal:</label>
        <select name="status_proposal" id="status_proposal" required>
            <option value="Disetujui" {{ $proposal->status_proposal == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="Ditolak" {{ $proposal->status_proposal == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>

        <button type="submit">Simpan</button>
    </form>
@endsection
