@extends('layouts.app')

@section('content')
    <h2>Absensi QR - {{ $rundown->judul_rundown }} ({{ $rundown->tanggal_kegiatan }})</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <p id="loading-status" style="font-weight: bold; color: blue;">Mempersiapkan kamera...</p>
    <div id="reader" style="width: 300px; margin-bottom: 15px;"></div>


    {{-- Hasil Scan --}}
    <p id="scan-result"></p>

    <form method="POST" action="{{ route('absensi.store') }}">
        @csrf

        {{-- Hidden Email (yang akan dikirim) --}}
        <input type="hidden" name="email" id="email-hidden">

        {{-- Tampilkan Email hasil scan --}}
        <label>Email dari QR:</label><br>
        <input type="text" id="email-display" readonly style="width: 300px;"><br>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Hidden rundown --}}
        <input type="hidden" name="id_rundown" value="{{ $rundown->id_rundown }}">

        <br>
        <button type="submit">Absen</button>
    </form>

    {{-- Scanner --}}
    <style>

    </style>    
   
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const scanner = new Html5Qrcode("reader");
        const config = { fps: 10, qrbox: 250 };

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('email-hidden').value = decodedText;
            document.getElementById('email-display').value = decodedText;
            document.getElementById('scan-result').innerText = "QR berhasil dibaca: " + decodedText;
            document.getElementById('loading-status').innerText = "Scan berhasil.";
            scanner.stop(); // Hentikan scan setelah berhasil
        }

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                scanner.start(devices[0].id, config, onScanSuccess);
                document.getElementById('loading-status').innerText = "Memulai kamera...";
            } else {
                document.getElementById('loading-status').innerText = "Kamera tidak ditemukan.";
            }
        }).catch(err => {
            document.getElementById('loading-status').innerText = "Gagal mengakses kamera: " + err;
        });
    </script>
@endsection
