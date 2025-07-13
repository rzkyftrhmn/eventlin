<h2>Login Admin</h2>

@if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif
@if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif

<form action="{{ route('admin.login') }}" method="POST">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label><br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="{{ route('admin.registerForm') }}">Daftar sebagai Admin</a></p>
