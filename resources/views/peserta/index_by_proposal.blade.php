@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Peserta untuk {{ $proposal->nama_acara }}</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="GET" class="filter-proposal-form" action="{{ route('peserta.byProposal', $proposal->id_proposal) }}">
                        <input type="text" class="filter-proposal-input" name="search" value="{{ $search ?? '' }}" placeholder="Cari peserta...">
                        <button type="submit" class="filter-proposal-button">Cari</button>
                    </form>
                    <div class="table-responsive mt-4">
                        @if ($pesertas->count())
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesertas as $peserta)
                                        <tr>
                                            <td>{{ $peserta->nim }}</td>
                                            <td>{{ $peserta->nama_peserta }}</td>
                                            <td>{{ $peserta->email }}</td>
                                            <td>
                                                <a href="{{ route('peserta.edit', $peserta->nim) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                <form action="{{ route('peserta.destroy', $peserta->nim) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                        <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $pesertas->links() }}
                        @else
                            <p>Tidak ada peserta terdaftar.</p>
                        @endif
                    </div>
                    @php
                        $id_proposal = $proposal->id_proposal;
                    @endphp
                    @if(auth()->guard('admin')->check())
                        <a class="btn btn-primary btn-icon text-white me-2 mb-3" href="{{ route('proposals.show', $id_proposal) }}">Kembali ke Detail Proposal</a>
                    @elseif(auth()->guard('panitia')->check())
                        @php
                            $jabatan = strtolower(auth('panitia')->user()->jabatan_panitia);
                        @endphp

                        @if(in_array($jabatan, ['ketua', 'sekretaris', 'bendahara']))
                            <a class="btn btn-primary btn-icon text-white me-2 mb-3" href="{{ route('proposal.superpanitia.show', $id_proposal) }}">Kembali ke Detail Proposal</a>
                        @else
                            <a class="btn btn-primary btn-icon text-white me-2 mb-3" href="{{ route('proposal.panitia.show.read', ['id' => $id_proposal]) }}">Kembali ke Detail Proposal</a>
                        @endif
                    @endif
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