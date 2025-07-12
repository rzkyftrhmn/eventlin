@csrf

{{-- Nama --}}
<div>
    <label>Nama Panitia:</label>
    <input type="text" name="nama_panitia" value="{{ old('nama_panitia', $panitia->nama_panitia ?? '') }}" required>
    @error('nama_panitia')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

{{-- Email --}}
<div>
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $panitia->email ?? '') }}" required>
    @error('email')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

{{-- Password --}}
<div>
    <label>Password:</label>
    <input type="password" name="password"
        @if(isset($panitia)) placeholder="Biarkan kosong jika tidak ingin mengubah password" @endif
        {{ isset($panitia) ? '' : 'required' }}>
    @error('password')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

{{-- Konfirmasi Password --}}
<div>
    <label>Konfirmasi Password:</label>
    <input type="password" name="password_confirmation"
        @if(isset($panitia)) placeholder="Ulangi password jika ingin mengganti" @endif
        {{ isset($panitia) ? '' : 'required' }}>
</div>

{{-- Jabatan --}}
<div>
    <label>Jabatan:</label>
    <select name="jabatan_panitia" id="jabatan" required>
        @foreach(['Ketua', 'Sekretaris', 'Bendahara', 'Panitia'] as $jabatan)
            <option value="{{ $jabatan }}" {{ (old('jabatan_panitia', $panitia->jabatan_panitia ?? '') == $jabatan) ? 'selected' : '' }}>{{ $jabatan }}</option>
        @endforeach
    </select>
    @error('jabatan_panitia')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

{{-- Divisi (Kondisional) --}}
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
    @error('id_divisi')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

{{-- Script untuk toggle divisi --}}
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
