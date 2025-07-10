@csrf

<div>
    <label for="id_divisi">Divisi</label>
    <select name="id_divisi" required>
        <option value="">-- Pilih Divisi --</option>
        @foreach ($divisis as $divisi)
            <option value="{{ $divisi->id_divisi }}" 
                {{ (isset($detailRundown) && $detailRundown->id_divisi == $divisi->id_divisi) ? 'selected' : '' }}>
                {{ $divisi->nama_divisi }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label for="judul_rundown">Judul Kegiatan</label>
    <input type="text" name="judul_rundown" value="{{ $detailRundown->judul_rundown ?? '' }}" required>
</div>

<div>
    <label for="jam_awal">Jam Mulai</label>
    <input type="time" name="jam_awal" value="{{ $detailRundown->jam_awal ?? '' }}" required>
</div>

<div>
    <label for="jam_akhir">Jam Selesai</label>
    <input type="time" name="jam_akhir" value="{{ $detailRundown->jam_akhir ?? '' }}" required>
</div>

<div>
    <label for="detail_kegiatan">Detail Kegiatan</label>
    <textarea name="detail_kegiatan" rows="3" required>{{ $detailRundown->detail_kegiatan ?? '' }}</textarea>
</div>

<button type="submit">Simpan</button>
