<h2>Pilih Proposal untuk Daftar</h2>

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
</ul>