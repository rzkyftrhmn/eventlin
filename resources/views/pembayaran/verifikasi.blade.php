@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Verifikasi Pembayaran Tiket</h1>
        </div>
    </div>

    @if (session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        @if($pembayarans->count())
                        <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                            <thead>
                                <tr>
                                    <th>Nama Peserta</th>
                                    <th>NIM</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <td>{{ $pembayaran->peserta->nama_peserta }}</td>
                                        <td>{{ $pembayaran->peserta->nim }}</td>
                                        <td>
                                            <a href="{{ asset($pembayaran->bukti_pembayaran) }}" target="_blank">
                                                <img src="{{ asset($pembayaran->bukti_pembayaran) }}" alt="Bukti" width="100" style="border:1px solid #ccc;">
                                            </a>
                                        </td>
                                        <td>{{ $pembayaran->status_pembayaran }}</td>
                                        <td>
                                            <form action="{{ route('verifikasi.pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status_pembayaran">
                                                    <option value="Menunggu" {{ $pembayaran->status_pembayaran == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="Diterima" {{ $pembayaran->status_pembayaran == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                                    <option value="Ditolak" {{ $pembayaran->status_pembayaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                                <button type="submit">Simpan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p colspan="5" style="text-align: center;">Tidak ada Peserta yang melakukan pembayaran.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
