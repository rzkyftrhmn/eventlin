@extends('layouts.app')

@extends('layouts.app')

@section('content')
    <h1>Edit Data Peserta</h1>
    @include('pesertas.form', ['peserta' => $peserta])
@endsection
