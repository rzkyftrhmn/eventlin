@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ isset($panitia) ? 'Edit Panitia' : 'Tambah Panitia' }}</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ 
                                    auth('admin')->check() 
                                        ? route('panitia.update', $panitia->id_panitia) 
                                        : route('panitia.Superupdate', $panitia->id_panitia) 
                                }}" 
                                method="POST">
                        @csrf
                        @if(isset($panitia)) @method('PUT') @endif
                        @include('panitia.form')
                    
                        <button type="submit" class="btn btn-green">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>      
            </div>
        </div>
    </div>
</div>
@endsection
