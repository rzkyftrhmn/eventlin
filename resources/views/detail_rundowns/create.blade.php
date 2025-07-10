@extends('layouts.app')

@section('content')
    <h2>Tambah Detail Rundown</h2>

    <form action="{{ route('detail-rundown.store',$rundown->id_rundown) }}" method="POST">
        <input type="hidden" name="id_rundown" value="{{ $rundown->id_rundown }}">
        @include('detail_rundowns._form')
    </form>

    <a href="{{ route('rundowns.show', $rundown->id_rundown) }}">Kembali</a>
@endsection
