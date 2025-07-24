<div class="form-group">
    <label class="form-label">Nama Panitia:</label>
    <input class="form-control" type="text" name="nama_panitia" value="{{ old('nama_panitia', $panitia->nama_panitia ?? '') }}" required>
    @error('nama_panitia')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">Email :</label>
    <input class="form-control" type="email" name="email" value="{{ old('email', $panitia->email ?? '') }}" required>
    @error('email')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">Password :</label>
    <input class="form-control" type="password" name="password" 
        @if(isset($panitia)) placeholder="Biarkan kosong jika tidak ingin mengubah password" @endif
        {{ isset($panitia) ? '' : 'required' }}>
    @error('password')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">Password Konfirmasi :</label>
    <input class="form-control" type="password" name="password_confirmation" 
        @if(isset($panitia)) placeholder="Ulangi password jika ingin mengganti" @endif
        {{ isset($panitia) ? '' : 'required' }}>
</div>

<div class="form-group">
    <label class="form-label">Jabatan :</label>
    @can('edit-jabatan-panitia')
    <select name="jabatan_panitia" class="form-control form-select select2" id="jabatan" style="width: 40%;" required>
        <option value="" disabled selected>Pilih Jabatan</option>
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

<div class="divisi-container" id="divisi-container" style="{{ strtolower($jabatanSekarang) === 'panitia' ? '' : 'display:none;' }}">
    <div class="form-group">
        <label class="form-label">Divisi :</label>
        <select name="id_divisi" class="form-control form-select select2" style="width: 40%;">
            <option value="" disable selected>Pilih Divisi</option>
            @foreach($divisis as $divisi)
                <option value="{{ $divisi->id_divisi }}" {{ (old('id_divisi', $panitia->id_divisi ?? '') == $divisi->id_divisi) ? 'selected' : '' }}>
                    {{ $divisi->nama_divisi }}
                </option>
            @endforeach
        </select>
        @error('divisi')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>
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