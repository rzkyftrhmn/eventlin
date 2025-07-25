@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Kuota Pendaftaran</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if(session('success'))
                        <p style="color: green">{{ session('success') }}</p>
                    @endif

                    @if($errors->any())
                        <ul style="color: red">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('kuota.update', $kuota->id_kuota_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Total Kuota:</label>
                            <input type="number" class="form-control" name="total_kuota" value="{{ old('total_kuota', $kuota->total_kuota) }}" style="width: 40%;" required>
                        </div>
                    
                        <div class="form-group">
                            <label class="form-label">Status Pendaftaran :</label>
                            <select name="status_pendaftaran" class="form-control form-select select2" data-bs-placeholder="Select Country" style="width: 40%;">
                                <option value="Buka" {{ $kuota->status_pendaftaran === 'Buka' ? 'selected' : '' }}>Buka</option>
                                <option value="Tutup" {{ $kuota->status_pendaftaran === 'Tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
            
                </div>
            </div>
        </div>
    </div>
@endsection
