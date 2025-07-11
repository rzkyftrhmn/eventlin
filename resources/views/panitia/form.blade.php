@csrf
<div>
    <label>Nama Panitia:</label>
    <input type="text" name="nama_panitia" value="{{ old('nama_panitia', $panitia->nama_panitia ?? '') }}" required>
</div>

<div>
    <label>Jabatan:</label>
    <select name="jabatan_panitia" id="jabatan" required>
        @foreach(['Ketua', 'Sekretaris', 'Bendahara', 'Panitia'] as $jabatan)
            <option value="{{ $jabatan }}" {{ (old('jabatan_panitia', $panitia->jabatan_panitia ?? '') == $jabatan) ? 'selected' : '' }}>{{ $jabatan }}</option>
        @endforeach
    </select>
</div>

<div id="divisi-container" style="display: none;">
    <label>Divisi:</label>
    <select name="id_divisi">
        <option value="">-- Pilih Divisi --</option>
        @foreach($divisis as $divisi)
            <option value="{{ $divisi->id_divisi }}" {{ (old('id_divisi', $panitia->id_divisi ?? '') == $divisi->id_divisi) ? 'selected' : '' }}>
                {{ $divisi->nama_divisi }}
            </option>
        @endforeach
    </select>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jabatanSelect = document.getElementById('jabatan');
    const divisiContainer = document.getElementById('divisi-container');

    function toggleDivisi() {
        divisiContainer.style.display = (jabatanSelect.value === 'Panitia') ? 'block' : 'none';
    }

    jabatanSelect.addEventListener('change', toggleDivisi);
    toggleDivisi(); // initial load
});
</script>
