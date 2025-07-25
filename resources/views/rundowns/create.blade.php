@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div>
                <h1 class="page-title">Tambah Rundown untuk: {{ $proposal->nama_acara }}</h1>
            </div>
        </div>
        @if ($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ route('rundowns.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="id_proposal" value="{{ $proposal->id_proposal }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Judul Rundown :</label>
                                <input class="form-control" type="text" name="judul_rundown" require>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal Kegiatan :</label>
                                <input class="form-control" type="date" name="tanggal_kegiatan" style="width: 40%;" min="{{ $proposal->tanggal_acara ?? date('Y-m-d') }}" required>
                            </div>
                            <button type="submit" class="btn btn-green">Simpan</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                        </form>
                    </div>      
                </div>
            </div>
        </div>
    </div>
@endsection
