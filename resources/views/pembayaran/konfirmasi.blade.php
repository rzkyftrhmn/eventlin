@extends('layouts.app')

@section('content')
 @if ($peserta->proposal->is_berbayar)
     @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif
     <p><strong>Bank:</strong>{{$peserta->proposal->nama_bank}}</p>
     <p><strong>Nomor Rekening:</strong>{{$peserta->proposal->nomor_rekening}}</p>
     <p><strong>Atas Nama:</strong>{{$peserta->proposal->nama_pemilik_rekening}}</p>
     <p><strong>Nominal:</strong>Rp.{{number_format($peserta->proposal->harga_tiket,0,',','.') }}</p>
     @php
        $pembayaranTerbaru = $peserta->pembayaranTiket;
    @endphp

    @if($pembayaranTerbaru && $pembayaranTerbaru->status_pembayaran == 'Diterima')
        <p><strong class="text-green-600">Terverifikasi</strong></p>
        <a href="{{ route('pembayaran.tiket', $peserta->nim) }}">Lihat Tiket</a>
    @elseif($peserta->pembayaranTiket)
     <p>Status: <strong class="text-yellow-600">{{ optional($pembayaranTerbaru)->status_pembayaran }}</strong></p>
     <a href="{{route('pembayaran.bayar', $peserta->nim)}}" class="btn btn-warning">Ubah Bukti Pembayaran</a>
     <img src="{{ asset(optional($pembayaranTerbaru)->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width:200px;">
    @else
    <a href="{{ route('pembayaran.bayar', $peserta->nim) }}" class="btn btn-primary">Upload Bukti Pembayaran</a>
    @endif
 @else
     <p>Proposal ini tidak memerlukan pembayaran.</p>
  @endif

    
@endsection