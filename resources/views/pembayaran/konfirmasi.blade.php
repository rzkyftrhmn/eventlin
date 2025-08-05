@extends('peserta.dashboard')
@section('content')
<div class="home-event">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-event">
                    <div class="home-title">
                        <h3>Pembayaran</h3>
                    </div>
                    <div class="title-home-event d-flex">
                        <a href="{{ route('peserta.content_dashboard') }}">
                            <img src="{{ asset('assets/img-peserta/home.png')}}" height="23" alt="">
                        </a>
                        <p>/ Pembayaran</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card-pembayaran">
        @if ($peserta->proposal->is_berbayar)

            @if (session('success'))
                <div class="notif success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="notif error">{{ session('error') }}</div>
            @endif

            <h2>Informasi Pembayaran</h2>
            <ul class="pembayaran-list">
                <li><strong>🏦 Bank:</strong> {{ $peserta->proposal->nama_bank }}</li>
                <li><strong>💳 Nomor Rekening:</strong> {{ $peserta->proposal->nomor_rekening }}</li>
                <li><strong>🧾 Atas Nama:</strong> {{ $peserta->proposal->nama_pemilik_rekening }}</li>
                <li><strong>💰 Nominal:</strong> Rp.{{ number_format($peserta->proposal->harga_tiket, 0, ',', '.') }}</li>
            </ul>

            @php
                $pembayaranTerbaru = $peserta->pembayaranTiket;
            @endphp

            @if ($pembayaranTerbaru && $pembayaranTerbaru->status_pembayaran == 'Diterima')
                <p class="status status-verified">✔️ Terverifikasi</p>
                <a href="{{ route('pembayaran.tiket', $peserta->nim) }}" class="btn btn-primary">Lihat Tiket</a>
            @elseif ($pembayaranTerbaru)
                <p class="status status-pending">⌛ Status: {{ $pembayaranTerbaru->status_pembayaran }}</p>
                <a href="{{ route('pembayaran.bayar', $peserta->nim) }}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#uploadModal">Ubah Bukti Pembayaran</a>
                <div class="bukti-preview">
                    <img src="{{ asset($pembayaranTerbaru->bukti_pembayaran) }}" alt="Bukti Pembayaran">
                </div>
            @else
                <a href="{{ route('pembayaran.bayar', $peserta->nim) }}" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Bukti Pembayaran</a>
            @endif
            @if ($errors->has('bukti_pembayaran'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
                        uploadModal.show();
                    });
                </script>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form action="{{ route('pembayaran.uploadForm.store', $peserta->proposal->id_proposal) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $peserta->nim }}">

                    <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                    <label for="bukti_pembayaran" class="form-label">Bukti Transfer (PDF/JPG/PNG):</label>
                    <input type="file" name="bukti_pembayaran" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    @error('bukti_pembayaran')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

        @else
            <p class="no-payment">Proposal ini tidak memerlukan pembayaran.</p>
        @endif
    </div>

</div>

    
@endsection