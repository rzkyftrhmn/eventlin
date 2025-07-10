@extends('layouts.app')

@section('content')
    <h2>Edit Detail Rundown</h2>

    <form action="{{route('detail-rundowns.update', $detailRundown->id_detail_rundown)}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id_rundown" value="{{ $detailRundown->id_rundown }}">
        @include('detail_rundowns._form')
    </form>

    <a href="{{ route('rundowns.show', $detailRundown->id_rundown) }}">Kembali</a>
@endsection
