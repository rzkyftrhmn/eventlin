<div class="form-group">
    <label class="form-label">Nama Divisi :</label>
    <input class="form-control"type="text" name="nama_divisi" value="{{ old('nama_divisi', $divisi->nama_divisi ?? '') }}" required>
    @error('nama_divisi')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">Tugas Divisi :</label>
    <textarea class="form-control" name="list_tugas_divisi">{{ old('list_tugas_divisi', $divisi->list_tugas_divisi ?? '') }}</textarea>
</div>

