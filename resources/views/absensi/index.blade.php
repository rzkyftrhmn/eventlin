<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Rekap Absensi: {{ $rundown->judul_rundown }}</h2>
        <p>Tanggal: {{ $rundown->tanggal_kegiatan }}</p>
    
        <a href="{{ route('absensi.rekap.pdf', $rundown->id_rundown) }}" class="btn btn-primary" target="_blank">Export PDF</a>
    
        <table class="table table-bordered border-dark mt-3">
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
    
        <div style="margin-top: 15px;">
            {{ $panitias->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body> 
</html>