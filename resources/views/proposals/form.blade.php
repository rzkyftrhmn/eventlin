@if ($errors->any())
<div style="color:red;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div>
    <div class="form-group">
        <label class="form-label">Nama Acara:</label>
        <input type="text" class="form-control" name="nama_acara" value="{{ old('nama_acara', $proposal->nama_acara ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Jenis Acara:</label>
        <input type="text" class="form-control" name="jenis_acara" value="{{ old('jenis_acara', $proposal->jenis_acara ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Nama Pengusul:</label>
        <input type="text" class="form-control" name="nama_pengusul" value="{{ old('nama_pengusul', $proposal->nama_pengusul ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Judul Proposal:</label>
        <input type="text" class="form-control" name="judul_proposal" value="{{ old('judul_proposal', $proposal->judul_proposal ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">File Proposal (PDF/Word):</label>
        <input class="form-control" type="file" name="file_proposal">
    </div>

    @if (isset($proposal) && $proposal->file_proposal)
        <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank">Lihat File Lama</a><br>
    @endif

    <div class="form-group">
        <label class="form-label">Estimasi Peserta:</label>
        <input class="form-control" type="number" name="estimasi_peserta" value="{{ old('estimasi_peserta', $proposal->estimasi_peserta ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Kebutuhan Logistik:</label>
        <textarea class="form-control" name="kebutuhan_logistik" required>{{ old('kebutuhan_logistik', $proposal->kebutuhan_logistik ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Tanggal Acara:</label>
        <input class="form-control" type="date" name="tanggal_acara" value="{{ old('tanggal_acara', $proposal->tanggal_acara ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Waktu Acara:</label>
        <input class="form-control" type="time" name="waktu_acara" value="{{ old('waktu_acara', $proposal->waktu_acara ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Detail Acara</label>
        <textarea class="form-control" name="detail_acara" required>{{ old('detail_acara', $proposal->detail_acara ?? '') }}</textarea>
    </div>
</div>