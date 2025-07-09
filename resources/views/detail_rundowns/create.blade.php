@extends('layouts.app')

@section('content')
    <h2>Tambah Detail Rundown</h2>

    <form action="{{ route('detail-rundown.store', $rundown->id_rundown) }}" method="POST">
        @csrf

        <div>
            <label>Nama Kegiatan:</label>
            <input type="text" name="nama_kegiatan" required>
        </div>

        <div>
            <label>Jam Awal:</label>
            <input type="time" name="jam_awal" required>
        </div>

        <div>
            <label>Jam Akhir:</label>
            <input type="time" name="jam_akhir" required>
        </div>

        <div>
            <label>Detail Acara:</label>
            <textarea name="detail_acara" rows="3" required></textarea>
        </div>

        {{-- Nanti diganti dropdown divisi kalau sudah ada relasinya --}}
        <div>
            <label>ID Divisi (sementara):</label>
            <input type="number" name="id_divisi" placeholder="Contoh: 1">
        </div>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('rundowns.show', $rundown->id_rundown) }}">Kembali ke Detail Rundown</a>
@endsection
