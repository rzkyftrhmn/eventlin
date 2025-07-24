@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Peserta</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @include('peserta.form', ['peserta' => $peserta])
                    
                </div>      
            </div>
        </div>
    </div>
    
@endsection
