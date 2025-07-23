<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .ticket {
            border: 2px dashed #198754;
            padding: 30px;
            margin: 20px auto;
            width: 700px;
            background-color: #f8f9fa;
            position: relative;
        }

        .ticket::before,
        .ticket::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        .ticket::before {
            left: -20px;
        }

        .ticket::after {
            right: -20px;
        }

        .event-name {
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: 600;
            margin-top: 15px;
        }

        .barcode {
            margin-top: 30px;
            text-align: center;
        }

        .barcode img {
            width: 200px;
        }
    </style>
</head>
<body>

<div class="ticket">
    <div class="text-center mb-4">
        <div class="event-name">{{ $peserta->proposal->nama_acara }}</div>
        <small>{{ \Carbon\Carbon::parse($peserta->proposal->tanggal_acara)->format('d M Y, H:i') }}</small>
    </div>

    <hr>

    <div>
        <p><span class="section-title">Nama:</span> {{ $peserta->nama_peserta }}</p>
        <p><span class="section-title">NIM:</span> {{ $peserta->nim }}</p>
        <p><span class="section-title">Tempat:</span> {{ $peserta->proposal->tempat_acara ?? 'Lokasi Acara' }}</p>
        <p><span class="section-title text-success">Status Pembayaran:</span> LUNAS / TERVERIFIKASI</p>
    </div>

    <div class="barcode">
        {{-- Bisa diisi dengan QR Code atau kode tiket --}}
        {{-- <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(100)->generate($peserta->nim)) }}"> --}}
        <p style="font-size: 18px;">Kode Tiket: <strong>{{ strtoupper(substr($peserta->nim, -6)) }}</strong></p>
    </div>
</div>

</body>
</html>
