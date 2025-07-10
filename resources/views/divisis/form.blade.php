@csrf
<div>
    <label>Nama Divisi</label>
    <input type="text" name="nama_divisi" value="{{ old('nama_divisi', $divisi->nama_divisi ?? '') }}" required>
</div>

<div>
    <label>List Tugas Divisi</label>
    <textarea name="list_tugas_divisi" rows="4">{{ old('list_tugas_divisi', $divisi->list_tugas_divisi ?? '') }}</textarea>
</div>

<button type="submit">Simpan</button>
