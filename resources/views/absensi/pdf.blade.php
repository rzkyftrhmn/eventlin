<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi - {{ $rundown->judul_rundown }}</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3>Rekap Absensi Panitia</h3>
    <p><strong>Rundown:</strong> {{ $rundown->judul_rundown }}</p>
    <p><strong>Tanggal:</strong> {{ $rundown->tanggal_kegiatan }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Panitia</th>
                <th>Jabatan</th>
                <th>Divisi</th>
                <th>Status Kehadiran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($panitias as $panitia)
                <tr>
                    <td>{{ $panitia->nama_panitia }}</td>
                    <td>{{ $panitia->jabatan_panitia }}</td>
                    <td>{{ $panitia->divisi->nama_divisi ?? '-' }}</td>
                    <td>{{ $panitia->absensi->last()->status_kehadiran ?? '-' }}</td>
                    <td>{{ $panitia->absensi->last()->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
