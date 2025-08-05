@extends('peserta.dashboard')
@section('content')
<div class="section-hero text-center text-white" style="background-image: url('/assets/img-peserta/bg_home.jpg');">
    <h2>Jadilah bagian dari moment yang menginspirasi!</h2>
</div>

<div class="event-section">
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
            <div class="col-lg-4 col-sm-12">
                <div class="card-event">
                    <div class="img">
                        <img src="{{ asset('assets/img-peserta/event123.jpg')}}" alt="">
                    </div>
                    <div class="title-event-card">
                        <h2 style="margin-left: 4px;">{{ $proposal->nama_acara }}</h2>
                        <div class="date d-flex" style="margin-left: 4px;">
                            <img src="{{ asset('assets/img-peserta/calendar (1).png')}}" alt="">
                            <p>{{ $proposal->tanggal_acara }}</p>
                        </div>

                        <a class="button-register" href="{{ route('peserta.formRegister', $proposal->id_proposal) }}">
                            <button>Daftar Sekarang</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
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

        
        <div class="col-lg-4 col-sm-12">
        <div class="card-kebijakan text-center">
            <div class="img">
            <img src="{{ asset('assets/img-peserta/ticket-blue.png')}}" alt="">
            </div>
            <div class="title-card-kebijakan">
            <h4>Pembelian Tiket</h4>
            <p>Maksimal 1 tiket per akun.</p>
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-sm-12">
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

        <div class="col-lg-4 col-sm-12">
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