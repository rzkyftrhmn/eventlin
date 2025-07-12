@extends('layouts.app')

@section('content')
<h2>Tambah Peserta</h2>
<form action="{{ route('peserta.store') }}" method="POST">
    @include('peserta.form')
    <button type="submit">Simpan</button>
</form>
@endsection
