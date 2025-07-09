@extends('layouts.app')

@section('content')
    <h2>Edit Detail Rundown</h2>

    <form action="{{ route('detail-rundown.update', $detail->id_detail_rundown) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Kegiatan:</label>
            <input type="text" name="nama_kegiatan" value="{{ $detail->nama_kegiatan }}" required>
        </div>

        <div>
            <label>Jam Awal:</label>
            <input type="time" name="jam_awal" value="{{ $detail->jam_awal }}" required>
        </div>

        <div>
            <label>Jam Akhir:</label>
            <input type="time" name="jam_akhir" value="{{ $detail->jam_akhir }}" required>
        </div>

        <div>
            <label>Detail Acara:</label>
            <textarea name="detail_acara" rows="3" required>{{ $detail->detail_acara }}</textarea>
        </div>

        <div>
            <label>ID Divisi (sementara):</label>
            <input type="number" name="id_divisi" value="{{ $detail->id_divisi }}">
        </div>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('rundowns.show', $detail->id_rundown) }}">Kembali ke Detail Rundown</a>
@endsection
