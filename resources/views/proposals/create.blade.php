@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Proposal</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('proposals.form', ['proposal' => null])

                        <button type="submit" class="btn btn-green">Submit</button>
                        <button type="cancel" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>      
            </div>
        </div>
    </div>

    
@endsection