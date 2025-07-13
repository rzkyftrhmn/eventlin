@extends('layouts.app')

@section('content')
    <h2>Edit Kuota Pendaftaran</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('kuota.update', $kuota->id_kuota_pendaftaran) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Total Kuota:</label>
            <input type="number" name="total_kuota" value="{{ old('total_kuota', $kuota->total_kuota) }}" required>
        </div>

        <div>
            <label>Status Pendaftaran:</label>
            <select name="status_pendaftaran" required>
                <option value="Buka" {{ $kuota->status_pendaftaran === 'Buka' ? 'selected' : '' }}>Buka</option>
                <option value="Tutup" {{ $kuota->status_pendaftaran === 'Tutup' ? 'selected' : '' }}>Tutup</option>
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection
