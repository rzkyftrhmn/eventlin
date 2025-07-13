<h2>Dashboard Peserta</h2>
<p>Selamat datang, {{ $peserta->nama_peserta }}!</p>
<p>Terdaftar di Acara: {{ $peserta->proposal->nama_acara }}</p>

<form action="{{ route('peserta.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
