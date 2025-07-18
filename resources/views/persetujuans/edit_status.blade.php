@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Ubah Status Persetujuan</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="
                            @if(auth('admin')->check())
                                {{ route('persetujuans.updateStatus', $persetujuan->id_persetujuan) }}
                            @elseif(auth('panitia')->check() && in_array(strtolower(auth('panitia')->user()->jabatan_panitia), ['ketua', 'sekretaris', 'bendahara']))
                                {{ route('persetujuans.SuperupdateStatus', $persetujuan->id_persetujuan) }}
                            @else
                                #
                            @endif
                        " 
                        method="POST"
                        >
                            @csrf
                            @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Nama Acara:</label>
                            <input type="text" class="form-control" name="nama_acara" value="{{ $persetujuan->proposal->nama_acara ?? '-' }}" readonly>
                        </div>
                    
                        <div class="form-group">
                            <select name="status_persetujuan" class="form-control form-select select2" data-bs-placeholder="Select Country" style="width: 40%;">
                                <option value="Disetujui" {{ $persetujuan->status_persetujuan === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ $persetujuan->status_persetujuan === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-green">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>      
            </div>
        </div>
    </div>
@endsection
