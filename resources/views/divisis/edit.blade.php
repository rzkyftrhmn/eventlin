@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Divisi</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('divisis.update', $divisi->id_divisi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('divisis.form')

                        <button type="submit" class="btn btn-green">Update</button>
                        <a href="{{ route('divisis.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>      
            </div>
        </div>
    </div>
@endsection
