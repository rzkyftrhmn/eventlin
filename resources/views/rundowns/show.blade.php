@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Rundown</h1>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="card-card d-flex">
                        @php
                            $id_proposal = $rundown->id_proposal;
                        @endphp
    
                        @if(auth()->guard('admin')->check())
                            <a class="btn btn-primary" href="{{ route('proposals.show', $id_proposal) }}">Kembali ke Detail Proposal</a><br>
                            <a class="btn btn-primary" href="{{ route('rundowns.export.pdf', $rundown->id_rundown) }}" target="_blank" style="margin-left: 20px;">🖨 Export PDF</a>
                        @elseif(auth()->guard('panitia')->check())
                            @php
                                $jabatan = strtolower(auth('panitia')->user()->jabatan_panitia);
                            @endphp
    
                            @if(in_array($jabatan, ['ketua', 'sekretaris', 'bendahara']))
                                <a class="btn btn-primary" href="{{ route('proposal.superpanitia.show', $id_proposal) }}">Kembali ke Detail Proposal</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('proposal.panitia.show.read', ['id' => $id_proposal]) }}">Kembali ke Detail Proposal</a>
                            @endif
                            <br>
                            <a class="btn btn-primary" href="{{ route('rundowns.panitia.export.pdf', $rundown->id_rundown) }}" target="_blank" style="margin-left: 9px;">🖨 Export PDF</a>
                        @endif
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Judul Rundown :</td>
                                    <td>{{ $rundown->judul_rundown }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Kegiatan :</td>
                                    <td>{{ $rundown->tanggal_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Acara :</td>
                                    <td>{{ $rundown->proposal->nama_acara ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Rundown</h1>
        </div>
        @if(auth('admin')->check() || (auth('panitia')->check() && in_array(auth('panitia')->user()->jabatan_panitia, ['ketua', 'sekretaris', 'bendahara'])))
            <a class="btn btn-primary" href="{{ route('detail-rundowns.create', ['id_rundown' => $rundown->id_rundown]) }}">+ Tambah Detail Rundown</a>
        @endif
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form class="filter-proposal-form" method="GET">
                        <input class="filter-proposal-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan atau detail">
                        <button class="filter-proposal-button" type="submit">cari</button>
                    </form>
                    <div class="table-responsive mt-4">
                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                            <thead>
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                    <th>Detail Acara</th>
                                    <th>Divisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($detailRundowns as $detail)
                                    <tr>
                                        <td>{{ $detail->judul_rundown }}</td>
                                        <td>{{ $detail->jam_awal }}</td>
                                        <td>{{ $detail->jam_akhir }}</td>
                                        <td>{{ $detail->detail_kegiatan }}</td>
                                        <td>{{ $detail->divisi->nama_divisi ?? '-' }}</td>
                                        <td>
                                            @if(auth('admin')->check() || (auth('panitia')->check() && in_array(auth('panitia')->user()->jabatan_panitia, ['Ketua', 'Sekretaris', 'Bendahara'])))
                                                <a href="{{ route('detail-rundowns.edit', $detail->id_detail_rundown) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                <form action="{{ route('detail-rundowns.destroy', $detail->id_detail_rundown) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                        <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: #888;">Read Only</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if(!auth('panitia')->check() || !in_array(auth('panitia')->user()->jabatan_panitia, ['panitia']))
                                                <a href="{{ route('detail-rundowns.edit', $detail->id_detail_rundown) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                <form action="{{ route('detail-rundowns.destroy', $detail->id_detail_rundown) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                        <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: #888;">Read Only</span>
                                            @endif
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align: center;">Belum ada detail rundown.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $detailRundowns->links() }}
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
                    confirmButtonColor: '#fd0000ff',
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