@extends('layouts.app')
@section('content')
<h2>{{ isset($panitia) ? 'Edit Panitia' : 'Tambah Panitia' }}</h2>
<form action="{{ isset($panitia) ? route('panitia.update', $panitia->id_panitia) : route('panitia.store', $proposal->id_proposal) }}" method="POST">
    @if(isset($panitia)) @method('PUT') @endif
    @include('panitia.form')
    <button type="submit">Simpan</button>
</form>
@endsection
