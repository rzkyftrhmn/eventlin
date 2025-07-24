<form action="{{ isset($peserta) ? route('peserta.update', $peserta->nim) : route('peserta.store', ['id_proposal' => $proposal->id_proposal]) }}" method="POST">
    @csrf
    @if(isset($peserta))
        @method('PUT')
    @endif
    @if ($errors->any())
        <div style="color: red; font-weight: bold;">
            <p>Validasi gagal:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label class="form-label">NIM :</label>
        <input type="number" class="form-control" id="nim" name="nim" value="{{ old('nim', $peserta->nim ?? '') }}" {{ isset($peserta) ? 'readonly' : 'required' }}>
        @error('nim')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Nama Peserta :</label>
        <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}" required>
        @error('nama_peserta')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Email :</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $peserta->email ?? '') }}" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Hapus input tanggal, ganti dengan hanya tampilkan jika edit --}}
    @if(isset($peserta))
        <div class="form-group">
            <label class="form-label">Tanggal Pendaftaran :</label>
            <input type="text" class="form-control" value="{{ $peserta->tanggal_pendaftaran }}" readonly>
        </div>
    @endif

    <div class="form-group">
        <label class="form-label">Password :</label>
        <input type="password" class="form-control" id="password" name="password" {{ isset($peserta) ? '' : 'required' }}>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Konfirmasi Password :</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($peserta) ? '' : 'required' }}>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-green">Simpan</button>
    <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
</form>
