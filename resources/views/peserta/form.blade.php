@csrf

<div>
    <label>NIM:</label>
    <input type="text" name="nim" value="{{ old('nim', $peserta->nim ?? '') }}" {{ isset($peserta) ? 'readonly' : '' }}>
    @error('nim') <small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Proposal:</label>
    <select name="id_proposal">
        <option value="">-- Pilih Proposal --</option>
        @foreach($proposals as $proposal)
            <option value="{{ $proposal->id_proposal }}" {{ old('id_proposal', $peserta->id_proposal ?? '') == $proposal->id_proposal ? 'selected' : '' }}>
                {{ $proposal->nama_kegiatan }}
            </option>
        @endforeach
    </select>
    @error('id_proposal') <small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Nama Peserta:</label>
    <input type="text" name="nama_peserta" value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}">
    @error('nama_peserta') <small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $peserta->email ?? '') }}">
    @error('email') <small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Password:</label>
    <input type="password" name="password">
    @error('password') <small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Konfirmasi Password:</label>
    <input type="password" name="password_confirmation">
</div>

<div>
    <label>Status Pendaftaran:</label>
    <select name="status_pendaftaran">
        @foreach(['Diterima', 'Ditolak'] as $status)
            <option value="{{ $status }}" {{ old('status_pendaftaran', $peserta->status_pendaftaran ?? '') == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error('status_pendaftaran') <small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Tanggal Pendaftaran:</label>
    <input type="date" name="tanggal_pendaftaran" value="{{ old('tanggal_pendaftaran', $peserta->tanggal_pendaftaran ?? '') }}">
    @error('tanggal_pendaftaran') <small style="color:red">{{ $message }}</small> @enderror
</div>
