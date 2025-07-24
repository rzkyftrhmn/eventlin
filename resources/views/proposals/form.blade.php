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
        <label class="form-label">Nama Acara :</label>
        <input type="text" class="form-control" id="nama_acara" name="nama_acara"  value="{{ old('nama_acara', $proposal->nama_acara ?? '') }}" required>
    </div>
    <div class="form-group">
        <label class="form-label">Jenis Acara :</label>
        <input type="text" class="form-control" id="jenis_acara" name="jenis_acara"  value="{{ old('jenis_acara', $proposal->jenis_acara ?? '') }}" required>
    </div>
    <div class="form-group">
        <label class="form-label">Nama Pengusul :</label>
        <input type="text" class="form-control" id="nama_pengusul" name="nama_pengusul"  value="{{ old('nama_pengusul', $proposal->nama_pengusul ?? '') }}" required>
    </div>
    <div class="form-group">
        <label class="form-label">Judul Proposal :</label>
        <input type="text" class="form-control" id="judul_proposal" name="judul_proposal"  value="{{ old('judul_proposal', $proposal->judul_proposal ?? '') }}" required>
        @error('judul_proposal')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label">File Proposal (PDF/Word) :</label>
        <input type="file" class="form-control" name="file_proposal" style="width: 40%;">
    </div>

    @if (isset($proposal) && $proposal->file_proposal)
        <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank">Lihat File Lama</a><br>
    @endif

    <div class="form-group">
        <label class="form-label">Estimasi Peserta :</label>
        <input type="number" class="form-control" name="estimasi_peserta" value="{{ old('estimasi_peserta', $proposal->estimasi_peserta ?? '') }}" style="width: 40%;" required>
        @error('estimasi_peserta')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Kebutuhan Logistik:</label>
        <textarea class="form-control" name="kebutuhan_logistik" required>{{ old('kebutuhan_logistik', $proposal->kebutuhan_logistik ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Tanggal Acara :</label>
        <input type="date" class="form-control" name="tanggal_acara" value="{{ old('tanggal_acara', $proposal->tanggal_acara ?? '') }}" style="width: 40%;" required>
        @error('tanggal_acara')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Waktu Acara :</label>
        <input type="time" class="form-control" name="waktu_acara" value="{{ old('waktu_acara', $proposal->waktu_acara ?? '') }}" style="width: 40%;" required>
        @error('waktu_acara')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Detail Acara :</label>
        <textarea class="form-control" name="detail_acara" required>{{ old('detail_acara', $proposal->detail_acara ?? '') }}</textarea>
    </div>
    
    <div class="form-group">
        <label class="form-label">Jenis Acara:</label>
        <select class="select-bayar" name="is_berbayar" id="is_berbayar" required>
                <option value="0" {{ old('is_berbayar', $proposal->is_berbayar ?? '') == 0 ? 'selected' : '' }}>Gratis</option>
                <option value="1" {{ old('is_berbayar', $proposal->is_berbayar ?? '') == 1 ? 'selected' : '' }}>Berbayar</option>
        </select>
    </div>

    <div id="berbayar_fields" style="display: none; margin-top: 10px;">
        <div class="form-group"> 
            <label class="form-label">Harga Tiket:</label>
            <input type="number" class="form-control" name="harga_tiket" value="{{ old('harga_tiket', $proposal->harga_tiket ?? '') }}">
        </div>
        <div class="form-group"> 
            <label class="form-label">Nama Bank :</label>
            <input class="form-control" type="text" name="nama_bank" value="{{ old('nama_bank', $proposal->nama_bank ?? '') }}">
        </div>
        <div class="form-group"> 
            <label class="form-label">Nomor Rekening :</label>
            <input class="form-control" type="text" name="nomor_rekening" value="{{ old('nomor_rekening', $proposal->nomor_rekening ?? '') }}">
        </div>
        <div class="form-group"> 
            <label class="form-label">Nama Pemilik Rekening:</label>
            <input class="form-control" type="text" name="nama_pemilik_rekening" value="{{ old('nama_pemilik_rekening', $proposal->nama_pemilik_rekening ?? '') }}">
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const isBerbayarSelect = document.getElementById("is_berbayar");
        const berbayarFields = document.getElementById("berbayar_fields");

        function toggleFields() {
            if (isBerbayarSelect.value == "1") {
                berbayarFields.style.display = "block";
            } else {
                berbayarFields.style.display = "none";
            }
        }

        isBerbayarSelect.addEventListener("change", toggleFields);
        toggleFields(); // Jalankan sekali saat halaman load
    });
</script>