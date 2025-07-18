@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Detail Rundown</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{route('detail-rundowns.update', $detailRundown->id_detail_rundown)}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="id_rundown" value="{{ $detailRundown->id_rundown }}">
                        @include('detail_rundowns._form')

                        <button type="submit" class="btn btn-green">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
