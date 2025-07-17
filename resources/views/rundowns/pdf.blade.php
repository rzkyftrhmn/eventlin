<!DOCTYPE html>
<html>
<head>
    <title>Export PDF</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Detail Rundown: {{ $rundown->judul_rundown }}</h2>
    <p>Tanggal: {{ $rundown->tanggal_kegiatan }}</p>
    <p>Proposal: {{ $rundown->proposal->nama_acara ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Jam Awal</th>
                <th>Jam Akhir</th>
                <th>Detail</th>
                <th>Divisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rundown->detailRundowns as $detail)
                <tr>
                    <td>{{ $detail->judul_rundown }}</td>
                    <td>{{ $detail->jam_awal }}</td>
                    <td>{{ $detail->jam_akhir }}</td>
                    <td>{{ $detail->detail_kegiatan }}</td>
                    <td>{{ $detail->divisi->nama_divisi ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
