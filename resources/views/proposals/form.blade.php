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
    <label>Nama Acara:</label>
    <input type="text" name="nama_acara" value="{{ old('nama_acara', $proposal->nama_acara ?? '') }}" required><br>

    <label>Jenis Acara:</label>
    <input type="text" name="jenis_acara" value="{{ old('jenis_acara', $proposal->jenis_acara ?? '') }}" required><br>

    <label>Nama Pengusul:</label>
    <input type="text" name="nama_pengusul" value="{{ old('nama_pengusul', $proposal->nama_pengusul ?? '') }}" required><br>

    <label>Judul Proposal:</label>
    <input type="text" name="judul_proposal" value="{{ old('judul_proposal', $proposal->judul_proposal ?? '') }}" required><br>

    <label>File Proposal (PDF/Word):</label>
    <input type="file" name="file_proposal"><br>

    @if (isset($proposal) && $proposal->file_proposal)
        <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank">Lihat File Lama</a><br>
    @endif

    <label>Estimasi Peserta:</label>
    <input type="number" name="estimasi_peserta" value="{{ old('estimasi_peserta', $proposal->estimasi_peserta ?? '') }}" required><br>

    <label>Kebutuhan Logistik:</label>
    <textarea name="kebutuhan_logistik" required>{{ old('kebutuhan_logistik', $proposal->kebutuhan_logistik ?? '') }}</textarea><br>

    <label>Tanggal Acara:</label>
    <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara', $proposal->tanggal_acara ?? '') }}" required min="{{date('Y-m-d')}}"><br>

    <label>Waktu Acara:</label>
    <input type="time" name="waktu_acara" value="{{ old('waktu_acara', $proposal->waktu_acara ?? '') }}" required><br>

    <label>Detail Acara:</label>
    <textarea name="detail_acara" required>{{ old('detail_acara', $proposal->detail_acara ?? '') }}</textarea><br>

    <label>Jenis Acara:</label>
    <select name="is_berbayar" id="is_berbayar" required>
            <option value="0" {{ old('is_berbayar', $proposal->is_berbayar ?? '') == 0 ? 'selected' : '' }}>Gratis</option>
            <option value="1" {{ old('is_berbayar', $proposal->is_berbayar ?? '') == 1 ? 'selected' : '' }}>Berbayar</option>
    </select>

    <div id="berbayar_fields" style="display: none; margin-top: 10px;">
        <label>Harga Tiket:</label>
        <input type="number" name="harga_tiket" value="{{ old('harga_tiket', $proposal->harga_tiket ?? '') }}"><br>

        <label>Nama Bank:</label>
        <input type="text" name="nama_bank" value="{{ old('nama_bank', $proposal->nama_bank ?? '') }}"><br>

        <label>Nomor Rekening:</label>
        <input type="text" name="nomor_rekening" value="{{ old('nomor_rekening', $proposal->nomor_rekening ?? '') }}"><br>

        <label>Nama Pemilik Rekening:</label>
        <input type="text" name="nama_pemilik_rekening" value="{{ old('nama_pemilik_rekening', $proposal->nama_pemilik_rekening ?? '') }}"><br>
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

