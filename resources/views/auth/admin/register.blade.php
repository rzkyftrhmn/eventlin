<h2>Register Admin</h2>

<form method="POST" action="{{ route('admin.register') }}">
    @csrf
    <label>Nama:</label>
    <input type="text" name="nama_admin" value="{{ old('nama_admin') }}" required><br>
    @error('nama_admin') <span style="color:red">{{ $message }}</span><br> @enderror

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
<p>Sudah punya akun? <a href="{{ route('admin.loginForm') }}">Login sebagai Admin</a></p>