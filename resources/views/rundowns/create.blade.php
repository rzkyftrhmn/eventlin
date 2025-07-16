@extends('layouts.app')

@section('content')
    <h1>Tambah Rundown untuk: {{ $proposal->nama_acara }}</h1>
    
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rundowns.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_proposal" value="{{ $proposal->id_proposal }}">

        <div>
            <label>Judul Rundown:</label>
            <input type="text" name="judul_rundown" required>
        </div>

        <div>
            <label>Tanggal Kegiatan:</label>
            <input type="date" name="tanggal_kegiatan" <input type="date" name="tanggal_kegiatan"
                    value="{{ old('tanggal_kegiatan', $rundown->tanggal_kegiatan ?? '') }}"
                    min="{{ $proposal->tanggal_acara ?? date('Y-m-d') }}" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
