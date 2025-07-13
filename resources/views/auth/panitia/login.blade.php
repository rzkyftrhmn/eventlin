<h2>Login Panitia</h2>

<form action="{{ route('panitia.login') }}" method="POST">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br>
    @error('email') <span style="color:red">{{ $message }}</span><br> @enderror

    <label>Password:</label>
    <input type="password" name="password" required><br>
    @error('password') <span style="color:red">{{ $message }}</span><br> @enderror

    <label><input type="checkbox" name="remember"> Remember Me</label><br><br>

    <button type="submit">Login</button>
</form>
@if (session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif
 