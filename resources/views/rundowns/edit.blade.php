@extends('layouts.app')

@section('content')
    <h2>Edit Rundown</h2>

    <form action="{{ route('rundowns.update', $rundown->id_rundown) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Judul Rundown:</label>
            <input type="text" name="judul_rundown" value="{{ old('judul_rundown', $rundown->judul_rundown) }}" required>
        </div>

        <div>
            <label>Tanggal Kegiatan:</label>
            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $rundown->tanggal_kegiatan) }}" required>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('proposals.show', $rundown->id_proposal) }}">Kembali ke Proposal</a>
@endsection
