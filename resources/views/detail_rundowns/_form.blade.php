<div class="form-group">
    <label class="form-label">Divisi :</label>
    <select name="id_divisi" class="form-control form-select select2" id="id_divisi" style="width: 30%;" required>
        <option value="" disabled selected>Pilih Divisi</option>
        @foreach ($divisis as $divisi)
            <option value="{{ $divisi->id_divisi }}" 
                {{ (isset($detailRundown) && $detailRundown->id_divisi == $divisi->id_divisi) ? 'selected' : '' }}>
                {{ $divisi->nama_divisi }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label class="form-label">Judul Kegiatan :</label>
    <input class="form-control" type="text" name="judul_rundown" value="{{ $detailRundown->judul_rundown ?? '' }}" required>
</div>

<div class="form-group">
    <label class="form-label">Jam Mulai :</label>
    <input class="form-control" type="time" name="jam_awal" value="{{ $detailRundown->jam_awal ?? '' }}" style="width: 30%;" required>
</div>

<div class="form-group">
    <label class="form-label">Jam Selesai :</label>
    <input class="form-control" type="time" name="jam_akhir" value="{{ $detailRundown->jam_akhir ?? '' }}" style="width: 30%;" required>
</div>

<div class="form-group">
    <label class="form-label">Detail Kegiatan :</label>
    <textarea class="form-control" name="detail_kegiatan" required>{{ $detailRundown->detail_kegiatan ?? '' }}</textarea>
</div>