@extends('peserta.dashboard')
@section('content')
<div class="section-hero text-center text-white" style="background-image: url('/assets/img-peserta/bg_home.jpg');">
    <h2>Jadilah bagian dari moment yang menginspirasi!</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-7 mb-5">
        <div class="card-filter">

        <!-- Kategori -->
        <div class="filter-item-content">
            <label for="kategori">Kategori</label>
            <select id="kategori">
                <option>All</option>
                <option>seminar</option>
                <option>konser</option>
                <option>webinar</option>
            </select>
        </div>

        <div class="search-bar-wrapper">
            <input type="text" placeholder="search..." />
            <button type="submit">
            <img src="{{ asset('assets/img-peserta/search.png')}}" alt="Search" />
            </button>
        </div>

        </div>
    </div>
    </div>
</div>

<div class="event-section p-5">
    <div class="blur-svg blur-blue" style="background-image: url(/assets/img-peserta/blur-blue.png);"></div>
    <div class="blur-svg blur-dark" style="background-image: url(/assets/img-peserta/blur-dark.png);"></div>

    <div class="container position-relative">
    <div class="row">
        <div class="col-12">
        <div class="title-section-event text-center">
            <p>Upcoming event</p>
            <h3>Featured Events</h3>
        </div>
        </div>

        @foreach($proposals as $proposal)
        <div class="col-4">
            <div class="card-event">
                <div class="img">
                    <img src="{{ asset('assets/img-peserta/event-konser2.jpg')}}" alt="">
                </div>
                <div class="title-event-card">
                    <h2>{{ $proposal->nama_acara }}r</h2>
                    <div class="date d-flex">
                        <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                        <p>{{ $proposal->tanggal_acara }}</p>
                    </div>
                    <p>Kuota : {{ $proposal->kuotaPendaftaran->kuota_terpakai }}/{{ $proposal->kuotaPendaftaran->total_kuota }}</p>
                    <a href="detail-event.html">See more</a>
                </div>
            </div>
        </div>
        @endforeach
        
        <!-- <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-konser.jpg')}}" alt="">
            </div>
            <div class="title-event-card">
            <h2>Entomology International Congress of Vancouver</h2>
            <div class="date d-flex">
                <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                <p>Sunday, 20 Dec 2025</p>
            </div>
            <a href="#">See more</a>
            </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-seminar.jpg')}}" alt="">
            </div>
            <div class="title-event-card">
            <h2>Entomology International Congress of Vancouver</h2>
            <div class="date d-flex">
                <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                <p>Sunday, 20 Dec 2025</p>
            </div>
            <a href="#">See more</a>
            </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-seminar-3.jpg')}}" alt="">
            </div>
            <div class="title-event-card">
            <h2>Entomology International Congress of Vancouver</h2>
            <div class="date d-flex">
                <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                <p>Sunday, 20 Dec 2025</p>
            </div>
            <a href="#">See more</a>
            </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-ux.jpg')}}" alt="">
            </div>
            <div class="title-event-card">
            <h2>Entomology International Congress of Vancouver</h2>
            <div class="date d-flex">
                <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                <p>Sunday, 20 Dec 2025</p>
            </div>
            <a href="#">See more</a>
            </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-webinar.jpg')}}" alt="">
            </div>
            <div class="title-event-card">
            <h2>Entomology International Congress of Vancouver</h2>
            <div class="date d-flex">
                <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                <p>Sunday, 20 Dec 2025</p>
            </div>
            <a href="#">See more</a>
            </div>
        </div>
        </div> -->
    </div>
    </div>
</div>

<div class="section-kebijakan">
    <div class="container">
    <div class="row">
        <div class="col-12">
        <h3 class="title-kebijakan text-center">
            Kebijakan Peserta
        </h3>
        </div>

        
        <div class="col-4">
        <div class="card-kebijakan text-center">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/ticket-blue.png')}}" alt="">
            </div>
            <div class="title-card-kebijakan">
            <h4>Pembelian Tiket</h4>
            <p>Maksimal 1 tiket per akun per hari.</p>
            </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-kebijakan text-center">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/operation.png')}}" alt="">
            </div>
            <div class="title-card-kebijakan">
            <h4>Batasan waktu pembayaran</h4>
            <p>Pembayaran hanya berlaku 24 jam sejak pemesanan.</p>
            </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-kebijakan text-center">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/id-card.png')}}" alt="">
            </div>
            <div class="title-card-kebijakan">
            <h4>Prosedur Masuk Acara</h4>
            <p>Wajib membawa bukti tiket dan kartu mahasiswa.</p>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

<div class="section-footer">
    <h4 class="text-white text-center">© 2025 Eventln – Platform Event Kampus Indonesia. All rights reserved.</h4>
</div>
@endsection

<!-- <h2>Pilih Proposal untuk Daftar</h2>

@if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif
@if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif

<ul>
@foreach($proposals as $proposal)
    <li style="margin-bottom: 20px;">
        <strong>{{ $proposal->nama_acara }}</strong> <br>
        Kuota: {{ $proposal->kuotaPendaftaran->kuota_terpakai }}/{{ $proposal->kuotaPendaftaran->total_kuota }} <br>

        <a href="{{ route('peserta.formRegister', $proposal->id_proposal) }}">
            <button>Daftar Sekarang</button>
        </a>

        <a href="{{ route('peserta.loginForm', $proposal->id_proposal) }}">
            <button>Login</button>
        </a>
    </li>
@endforeach
</ul> -->