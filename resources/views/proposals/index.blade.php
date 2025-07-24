@extends('layouts.app')

@section('content')
    <div>
        <div class="page-header">
            <div>
                <h1 class="page-title">Data Proposal</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <a href="{{ route('proposals.create') }}" class="btn btn-primary btn-icon text-white me-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Add Proposal
                </a>
            </div>
        </div>
    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('proposals.index') }}" method="GET" class="filter-proposal-form" style="margin-bottom: 15px;">
                                <select name="status_filter" class="filter-proposal-select">
                                    <option value="">-- Filter Status --</option>
                                    <option value="Diajukan" {{ request('status_filter') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                    <option value="Disetujui" {{ request('status_filter') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Ditolak" {{ request('status_filter') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Proposal..." class="filter-proposal-input">
                                <button type="submit" class="filter-proposal-button">Terapkan</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Acara</th>
                                        <th>Judul Proposal</th>
                                        <th>Status</th>
                                        <th>File Proposal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @forelse ($proposals as $proposal)
                                        <tr>
                                            <td>{{ ($proposals->currentPage() - 1) * $proposals->perPage() + $loop->iteration }}</td>
                                            <td>{{ $proposal->nama_acara }}</td>
                                            <td>{{ $proposal->judul_proposal }}</td>
                                            <td>{{ $proposal->status_proposal }}</td>
                                            <td>
                                                <a href="{{ asset($proposal->file_proposal) }}" target="_blank" class="btn btn-info btn-sm rounded-11" data-bs-toggle="tooltip" data-bs-original-title="Lihat File" style="height: 30px;"><i class="fe fe-file" style="font-size: 16px; color: white;"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('proposals.show', $proposal->id_proposal) }}" class="btn btn-info btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Lihat" style="height: 30px;"><i class="fe fe-eye" style="font-size: 16px;"></i></a>
                                                <a href="{{ route('proposals.edit', $proposal->id_proposal) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                <form action="{{ route('proposals.destroy', $proposal->id_proposal) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                        <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center;">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $proposals->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-konfirmasi');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // hentikan submit default

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#1878FF',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
