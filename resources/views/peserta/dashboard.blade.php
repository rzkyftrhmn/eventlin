<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-peserta.css')}}">
    <title>Hello, world!</title>
  </head>
  <body>

    @php
        $peserta = Auth::user();
    @endphp

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
      <div class="container">
        <img id="brand-logo" src="{{ asset('assets/img-peserta/event_default.png')}}" height="50" width="50" alt="Brand">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active eventln-nav" aria-current="page" href="{{ route('peserta.content_dashboard') }}">Eventln</a>
            </li>
          </ul>

          <div class="d-flex align-items-center ms-auto nav-title">
            @auth('peserta')
            <div class="dropdown hover-dropdown">
              <a href="#" class="d-flex align-items-center text-white dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i> {{ $peserta->nama_peserta }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow rounded-3" style="width: 100px;" aria-labelledby="dropdownUser">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('peserta.profile', auth('peserta')->user()->nim) }}">
                    <i class="bi bi-person-badge me-2"></i> Profil
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li style="margin-left: 12px;">
                    <form action="{{ route('peserta.logout') }}">
                        <button class="dropdown-item text-danger d-flex align-items-center" type="submit">
                          <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
              </ul>
            </div>
            @endauth

            @guest('peserta')
            <a href="#" class="text-white me-3 d-flex align-items-center" style="text-decoration: none;">
              <img src="{{ asset('assets/img-peserta/icon_login_500px.png')}}" class="login" alt="Login" width="20" class="me-1">Login
            </a>
            <a href="#" class="text-white me-3 d-flex align-items-center" style="text-decoration: none;">
              <img src="{{ asset('assets/img-peserta/icon_register_500px.png')}}" alt="Register" width="25" class="me-1">Register
            </a>
            @endguest
          </div>

          @auth('peserta')
          <a href="{{ route('peserta.all_event') }}" class="btn browse-event" type="submit">Browse Events</a>
          @endauth
        </div>
      </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        const loginIcon = document.querySelector('img[alt="Login"]');
        const registerIcon = document.querySelector('img[alt="Register"]');
        const bookingIcon = document.querySelector('img[alt="booking"]');
        const brandLogo = document.querySelector('img[alt="Brand"]');

        const loginDark = "{{ asset('assets/img-peserta/icon_login_dark.png') }}";
        const registerDark = "{{ asset('assets/img-peserta/icon_register_dark.png') }}";
        const bookingDark = "{{ asset('assets/img-peserta/booking-dark.png') }}";
        const logoDark = "{{ asset('assets/img-peserta/event-dark.png') }}";

        const loginLight = "{{ asset('assets/img-peserta/icon_login_500px.png') }}";
        const registerLight = "{{ asset('assets/img-peserta/icon_register_500px.png') }}";
        const bookingLight = "{{ asset('assets/img-peserta/booking.png') }}";
        const logoLight = "{{ asset('assets/img-peserta/event_default.png') }}";

        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                if (loginIcon) loginIcon.src = loginDark;
                if (registerIcon) registerIcon.src = registerDark;
                if (bookingIcon) bookingIcon.src = bookingDark;
                if (brandLogo) brandLogo.src = logoDark;
            } else {
                navbar.classList.remove('navbar-scrolled');
                if (loginIcon) loginIcon.src = loginLight;
                if (registerIcon) registerIcon.src = registerLight;
                if (bookingIcon) bookingIcon.src = bookingLight;
                if (brandLogo) brandLogo.src = logoLight;
            }
        });
    </script>




  </body>
</html>