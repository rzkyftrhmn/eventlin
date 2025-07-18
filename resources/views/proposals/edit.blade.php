@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Proposal</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('proposals.update', $proposal->id_proposal) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('proposals.form', ['proposal' => $proposal])
                    
                        <button type="submit" class="btn btn-green">Update</button>
                        <button type="cancel" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>      
            </div>
        </div>
    </div>
</div>
@endsection
