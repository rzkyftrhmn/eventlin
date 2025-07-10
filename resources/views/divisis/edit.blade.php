@extends('layouts.app')

@section('content')
    <h2>Edit Divisi</h2>
    <form action="{{ route('divisis.update', $divisi->id_divisi) }}" method="POST">
        @csrf
        @method('PUT')
        @include('divisis.form')
    </form>
@endsection
