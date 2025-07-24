@extends('peserta.dashboard')

@section('content')

<div class="home-detail-event" style="background-image: url(/assets/img-peserta/event-konser.jpg);">
    <div class="overlay"></div>
</div>


<div class="container">
    <div class="row mt-5">
        <div class="col-7">
            <div class="judul-event">
                <h2>Entomology International Congress of Vancouver</h2>
                <div class="card-kategori">
                    <p>Category</p>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="judul-lokasi">
                <h2>Lokasi</h2>
                <div class="lokasi">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe, error!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-7">
            <div class="keterangan-event">
                <div class="judul-keterangan">
                    <h2>Lorem, ipsum.</h2>
                </div>
                <div class="keterangan">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod blanditiis ipsa rem vitae possimus. Inventore officiis quasi debitis rerum voluptatem temporibus consequatur corrupti. Maiores unde, ut, voluptatem ipsam iure esse distinctio sapiente neque nam expedita eveniet. Saepe ut dolorem eligendi rem sit voluptatum, itaque fuga sapiente, suscipit molestias modi doloribus blanditiis facilis ex deleniti unde, quis maiores! Rerum quae alias dignissimos placeat, obcaecati harum deleniti quod tempore cupiditate accusamus dolores quia iste. Praesentium non veniam voluptatem dicta quas hic eveniet, voluptatibus quasi corporis facere, ipsam expedita delectus dolorem reiciendis in accusantium neque a nobis odit dolor aliquam quisquam! Omnis, natus.</p>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="waktu-event">
                <div class="judul-waktu">
                    <h2>Waktu</h2>
                </div>
                <div class="waktu">
                    26 Nov 2025 06:30 PM - 29 Nov 2025 10:00 PM
                </div>
            </div>

            @if ($peserta->proposal->is_berbayar)
            <div class="card-tiket text-center mt-4">
                <a href="{{route('pembayaran.konfirmasi',$peserta->nim)}}">
                    <button class="btn-tiket">
                        <img src="{{ asset('assets/img-peserta/ticket.png')}}" alt="icon tiket" height="50" width="50" class="icon-tiket">
                        Dapatkan Tiket Sekarang
                    </button>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection