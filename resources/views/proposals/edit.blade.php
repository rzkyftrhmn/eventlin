@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Proposal</h1>

    <form action="{{ route('proposals.update', $proposal->id_proposal) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('proposals.form', ['proposal' => $proposal])

        <button type="submit">Update</button>
    </form>
</div>
@endsection
