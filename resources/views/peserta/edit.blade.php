@extends('layouts.app')

@section('content')
    <h1>Edit Data Peserta</h1>
    @include('peserta.form', ['peserta' => $peserta])
@endsection
