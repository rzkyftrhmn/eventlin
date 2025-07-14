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
    @can('edit-jabatan-panitia')
        <select name="jabatan_panitia" id="jabatan" required>
            @foreach(['Ketua', 'Sekretaris', 'Bendahara', 'Panitia', 'Akademik'] as $jabatan)
                <option value="{{ $jabatan }}"
                    {{ strtolower(old('jabatan_panitia', $panitia->jabatan_panitia ?? '')) === strtolower($jabatan) ? 'selected' : '' }}>
                    {{ $jabatan }}
                </option>
            @endforeach
        </select>
    @else
        {{-- Hidden input + display readonly --}}
        <input type="hidden" name="jabatan_panitia" value="{{ old('jabatan_panitia', $panitia->jabatan_panitia ?? 'Panitia') }}">
        <span><strong>{{ old('jabatan_panitia', $panitia->jabatan_panitia ?? 'Panitia') }}</strong></span>
    @endcan

    @error('jabatan_panitia')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

{{-- Divisi (kondisional) --}}
@php
    $jabatanSekarang = old('jabatan_panitia', $panitia->jabatan_panitia ?? 'Panitia');
@endphp

<div id="divisi-container" style="{{ strtolower($jabatanSekarang) === 'panitia' ? '' : 'display:none;' }}">
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

{{-- Toggle script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jabatanSelect = document.getElementById('jabatan');
    const divisiContainer = document.getElementById('divisi-container');

    function toggleDivisi(jabatan) {
        if (!divisiContainer) return;
        divisiContainer.style.display = (jabatan.toLowerCase() === 'panitia') ? 'block' : 'none';
    }

    if (jabatanSelect) {
        jabatanSelect.addEventListener('change', function () {
            toggleDivisi(jabatanSelect.value);
        });
        toggleDivisi(jabatanSelect.value);
    } else {
        // Kalau tidak ada <select>, pakai input hidden
        const hiddenInput = document.querySelector('input[name="jabatan_panitia"]');
        if (hiddenInput) {
            toggleDivisi(hiddenInput.value);
        }
    }
});
</script>
