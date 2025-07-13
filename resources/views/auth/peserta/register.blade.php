<h2>Form Pendaftaran untuk {{ $proposal->nama_acara }}</h2>

<form action="{{ route('peserta.register', $proposal->id_proposal) }}" method="POST">
    @csrf
    <label>NIM:</label>
    <input type="text" name="nim" value="{{ old('nim') }}" required><br>
    @error('nim') <span style="color:red">{{ $message }}</span><br> @enderror

    <label>Nama:</label>
    <input type="text" name="nama_peserta" value="{{ old('nama_peserta') }}" required><br>
    @error('nama_peserta') <span style="color:red">{{ $message }}</span><br> @enderror

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br>
    @error('email') <span style="color:red">{{ $message }}</span><br> @enderror

    <label>Password:</label>
    <input type="password" name="password" required><br>
    @error('password') <span style="color:red">{{ $message }}</span><br> @enderror

    <label>Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Daftar</button>
</form>
