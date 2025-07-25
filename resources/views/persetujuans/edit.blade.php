@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Status Proposal</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('persetujuans.updateAkademik', $proposal->id_proposal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Nama Acara :</label>
                            <input class="form-control" type="text" name="nama_acara" value="{{ $proposal->nama_acara }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Judul Proposal :</label>
                            <input class="form-control" type="text" name="judul_proposal" value="{{ $proposal->judul_proposal }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Proposal :</label>
                            <select name="status_proposal" class="form-control form-select select2" id="status_proposal" style="width: 40%;" required>
                                <option value="Disetujui" {{ $proposal->status_proposal == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ $proposal->status_proposal == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
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
