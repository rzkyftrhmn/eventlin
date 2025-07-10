@extends('layouts.app')

@section('content')
    <h2>Tambah Divisi</h2>
    <form action="{{ route('divisis.store') }}" method="POST">
        @include('divisis.form')
    </form>
@endsection
