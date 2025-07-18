<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 d-flex align-items-center justify-content-center" style="height: 100vh;">
                <div class="img">
                    <img style="height: 500px; width: 500px;" src="{{ asset('assets/images/login/login.png') }}" alt="">
                </div>
            </div>
            <div class="col-6 text-center d-flex align-items-center justify-content-center">
                <div class="card-form">

                    <h2 class="mb-2">Log In</h2>
                    <p class="title mb-1">Masuk untuk terhubung dengan</p>
                    <p class="title mt-0">event, ilmu, dan inspirasi baru!</p>

                    <form action="{{ route('peserta.login') }}" method="POST">
                        @csrf

                        <div class="mt-4 mb-3">
                            <input type="number" name="nim" class="form-control custom-input" placeholder="Nim" value="{{ old('nim') }}">
                            @error('nim')
                                <div class="text-red-500 mt-1 text-sm" style="color: red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password" class="form-control custom-input" placeholder="Password">
                            @error('password')
                                <div class="text-red-500 mt-1 text-sm" style="color: red; font-size: 14px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3 text-start ms-4">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>

                        <button type="submit" class="button">Login</button>
                    </form>

                    <div class="content-title mt-3">
                        <p>Tidak memiliki akun? <a href="#">Sign up</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>


