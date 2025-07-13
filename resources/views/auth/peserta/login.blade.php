<h2>Login Peserta</h2>

<form action="{{ route('peserta.login') }}" method="POST">
    @csrf

    <label for="nim">NIM:</label>
    <input type="text" name="nim" value="{{ old('nim') }}" required><br>
    @error('nim') <span style="color:red">{{ $message }}</span><br> @enderror

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    @error('password') <span style="color:red">{{ $message }}</span><br> @enderror

    <div>
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Ingat Saya</label>
    </div><br>

    <button type="submit">Login</button>
</form>
