@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Detail Rundown</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('detail-rundown.store',$rundown->id_rundown) }}" method="POST">
                        @csrf
                                                
                        <input type="hidden" name="id_rundown" value="{{ $rundown->id_rundown }}">
                        @include('detail_rundowns._form')
                
                        <button type="submit" class="btn btn-green">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>      
            </div>
        </div>
    </div>
@endsection
