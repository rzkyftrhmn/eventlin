@extends('peserta.dashboard')

@section('content')

<div class="home-event">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-event">
                    <div class="home-title">
                        <h3>Events</h3>
                    </div>
                    <div class="title-home-event d-flex">
                        <a href="{{ route('peserta.content_dashboard') }}">
                            <img src="{{ asset('assets/img-peserta/home.png')}}" height="23" alt="">
                        </a>
                        <p>/ Event</p>
                    </div>
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
        <div class="dropdown-list-event d-flex mb-4">

            
             <div class="filter-event">
                <!-- Kota -->
                <div class="filter-item">
                    <label for="kota">Kota</label>
                    <select id="kota">
                        <option>All</option>
                        <option>Bandung</option>
                        <option>Jakarta</option>
                        <option>semarang</option>
                    </select>
                </div>
                <!-- Kategori -->
                 <div class="filter-item">
                     <label for="kategori">Kategori</label>
                     <select id="kategori">
                         <option>All</option>
                         <option>seminar</option>
                         <option>konser</option>
                         <option>webinar</option>
                     </select>
                 </div>
                 <button class="btn btn-info">Cari</button>
             </div>
        </div>
        </div>

        <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-konser2.jpg')}}" alt="">
            </div>
            <div class="title-event-card">
            <h2>Entomology International Congress of Vancouver</h2>
            <div class="date d-flex">
                <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                <p>Sunday, 20 Dec 2025</p>
            </div>
            <a href="{{ route('peserta.detail_event') }}">See more</a>
            </div>
        </div>
        </div>
        
        <div class="col-4">
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
        </div>

        <div class="col-4">
        <div class="card-event">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/event-a.jpg')}}" alt="">
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
            <img src="{{ asset('assets/img-peserta/event-seminar2.jpg')}}" alt="">
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

    </div>
    </div>
</div>

@endsection