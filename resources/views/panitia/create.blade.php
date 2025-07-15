@extends('layouts.app')
@section('content')
<h2>{{ isset($panitia) ? 'Edit Panitia' : 'Tambah Panitia' }}</h2>
<form 
    action="
        @if(auth('admin')->check())
            {{ route('panitia.store', $proposal->id_proposal) }}
        @elseif(auth('panitia')->check() && in_array(strtolower(auth('panitia')->user()->jabatan_panitia), ['ketua', 'sekretaris', 'bendahara']))
            {{ route('panitia.Superstore', $proposal->id_proposal) }}
        @else
            #
        @endif
    " 
    method="POST"
>
    @if(isset($panitia)) @method('PUT') @endif
    @include('panitia.form')
    <button type="submit">Simpan</button>
</form>
@endsection
