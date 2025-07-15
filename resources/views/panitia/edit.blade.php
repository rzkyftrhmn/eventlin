@extends('layouts.app')
@section('content')
<h2>{{ isset($panitia) ? 'Edit Panitia' : 'Tambah Panitia' }}</h2>
<form 
    action="{{ 
        auth('admin')->check() 
            ? route('panitia.update', $panitia->id_panitia) 
            : route('panitia.Superupdate', $panitia->id_panitia) 
    }}" 
    method="POST">
    @if(isset($panitia)) @method('PUT') @endif
    @include('panitia.form')
    <button type="submit">Simpan</button>
</form>
@endsection
