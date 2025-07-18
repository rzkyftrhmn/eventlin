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
                    <form action="
                                    @if(auth('admin')->check())
                                        {{ route('panitia.store', $proposal->id_proposal) }}
                                    @elseif(auth('panitia')->check() && in_array(strtolower(auth('panitia')->user()->jabatan_panitia), ['ketua', 'sekretaris', 'bendahara']))
                                        {{ route('panitia.Superstore', $proposal->id_proposal) }}
                                    @else
                                        #
                                    @endif
                                " 
                        method="POST" enctype="multipart/form-data">
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
