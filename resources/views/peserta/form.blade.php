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
    <div>
        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" value="{{ old('nim', $peserta->nim ?? '') }}" {{ isset($peserta) ? 'readonly' : 'required' }}>
        @error('nim')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    <div>
        <label for="nama_peserta">Nama Peserta</label>
        <input type="text" name="nama_peserta" id="nama_peserta" value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}" required>
        @error('nama_peserta')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $peserta->email ?? '') }}" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Hapus input tanggal, ganti dengan hanya tampilkan jika edit --}}
    @if(isset($peserta))
        <div>
            <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
            <input type="text" value="{{ $peserta->tanggal_pendaftaran }}" readonly>
        </div>
    @endif

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" {{ isset($peserta) ? '' : 'required' }}>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" {{ isset($peserta) ? '' : 'required' }}>
    </div>

    <div style="margin-top: 10px;">
        <button type="submit">{{ isset($peserta) ? 'Update' : 'Daftar' }}</button>
    </div>
</form>
