@extends('layouts.app')

@section('content')
        <div class="page-header">
            <div>
                <h1 class="page-title">Edit Rundown</h1>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div style="color: red; font-weight: bold;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('rundowns.update', $rundown->id_rundown) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label class="form-label">Judul Rundown :</label>
                                <input class="form-control" type="text" name="judul_rundown" value="{{ old('judul_rundown', $rundown->judul_rundown) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Kegiatan :</label>
                                <input class="form-control" type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $rundown->tanggal_kegiatan) }}" min="{{ $proposal->tanggal_acara ?? date('Y-m-d') }}" required>
                            </div>
                        
                            <button type="submit" class="btn btn-green">Simpan</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                        </form>
                    </div>      
                </div>
            </div>
        </div>
@endsection
