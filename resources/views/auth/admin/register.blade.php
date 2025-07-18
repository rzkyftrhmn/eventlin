<!-- <h2>Register Admin</h2>

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
 -->

 <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <title>Register</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 text-center d-flex align-items-center justify-content-center">
                <div class="card-form">
                    <h2 class="mb-2">Register</h2>
                    <p class="title mb-1">Daftar sekarang dan jadi bagian dari</p>
                    <p class="title mt-0">berbagai event penuh ilmu & inspirasi!</p>

                    <form action="{{ route('admin.register') }}" method="POST">
                        @csrf

                        <div class="mt-4 mb-3">
                            <input type="text" name="nama_admin" class="form-control custom-input" placeholder="Nama Admin" value="{{ old('nama_admin') }}">
                            @error('nama_admin')
                                <div class="text-red-500 mt-1 text-sm" style="color:red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 mb-3">
                            <input type="text" name="email" class="form-control custom-input" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-red-500 mt-1 text-sm" style="color:red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password" class="form-control custom-input" placeholder="Password">
                            @error('password')
                                <div class="text-red-500 mt-1 text-sm" style="color:red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Password Konfirmasi">
                            @error('password_confirmation')
                                <div class="text-red-500 mt-1 text-sm" style="color:red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="button">Register</button>

                    </form>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center" style="height: 100vh;">
                <div class="img">
                    <img style="height: 500px; width: 500px;" src="{{ asset('assets/images/login/register.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>