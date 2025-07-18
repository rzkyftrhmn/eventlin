@extends('layout.app');

@section('content')
 @if ($peserta->proposal->is_berbayar)
     <p><strong>Bank:</strong>{{$peserta->proposal->nama_bank}}</p>
     <p><strong>Nomor Rekening:</strong>{{$peserta->proposal->nomor_rekening}}</p>
     <p><strong>Atas Nama:</strong>{{$peserta->proposal->nama_pemilik_rekening}}</p>
     <p><strong>Nominal:</strong>Rp.{{number_format($peserta->proposal->harga_tiket,0,',','.') }}</p>
    @if($peserta->pembayaran && $peserta->pembayaran->status_pembayaran == 'Diterima')
        <p><strong class="text-green-600">Terverifikasi</strong></p>
        <a href="{{route('pembayaran.tiket',$peserta->nim)}}">Lihat Tiket</a>
    @elseif($peserta->pembayaran)
     <p>Status: <strong class="text-yellow-600">{{ $peserta->pembayaran->status_pembayaran }}</strong></p>
     <a href="{{ route('pembayaran.uploadForm', $peserta->id) }}" class="btn btn-warning">Ubah Bukti Pembayaran</a>
    @else
    <a href="{{ route('pembayaran.uploadForm', $peserta->id) }}" class="btn btn-primary">Upload Bukti Pembayaran</a>
    @endif
 @else
     <p>Proposal ini tidak memerlukan pembayaran.</p>
  @endif

    
@endsection