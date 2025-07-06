@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Proposal</h1>

    <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('proposals.form', ['proposal' => null])

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
