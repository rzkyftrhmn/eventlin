@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">QR Code Absensi Anda</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="card custom-card">
                <div class="card-body p-3">
                    {!! $qrCode !!}
                </div>
            </div>
        </div>
    </div>
@endsection
