<h2>Rekap Absensi: {{ $rundown->judul_rundown }}</h2>
<p>Tanggal: {{ $rundown->tanggal_kegiatan }}</p>

<a href="{{ route('absensi.rekap.pdf', $rundown->id_rundown) }}" target="_blank">Export PDF</a>

<table border="1" cellpadding="8" cellspacing="0" style="margin-top: 10px; width: 100%;">
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
