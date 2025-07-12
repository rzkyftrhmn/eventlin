@extends('layouts.app')

@section('content')
<h2>Edit Peserta</h2>
<form action="{{ route('peserta.update', $peserta->nim) }}" method="POST">
    @method('PUT')
    @include('peserta.form')
    <button type="submit">Update</button>
</form>
@endsection
