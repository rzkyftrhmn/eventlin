@extends('layouts.app')
@php
    $id_proposal = $proposal->id_proposal;

    // Route untuk kembali ke detail proposal
    if (auth('admin')->check()) {
        $routeBack = route('proposals.show', $id_proposal);
        $routeTambahPanitia = route('panitia.create', $id_proposal);
    } elseif (auth('panitia')->check()) {
        $jabatan = strtolower(auth('panitia')->user()->jabatan_panitia);

        if (in_array($jabatan, ['ketua', 'sekretaris', 'bendahara'])) {
            $routeBack = route('proposal.superpanitia.show', $id_proposal);
            $routeTambahPanitia = route('panitia.Supercreate', $id_proposal);
        } else {
            $routeBack = route('proposal.panitia.show.read', ['id' => $id_proposal]);
            $routeTambahPanitia = route('panitia.create', $id_proposal);
        }
    } else {
        // default untuk debugging mode (misal akses publik)
        $routeBack = route('proposals.show', $id_proposal);
        $routeTambahPanitia = '#'; // atau nonaktifkan
    }
@endphp

@section('content')
    <!-- <h2>Daftar Panitia untuk {{ $proposal->nama_acara }}</h2>

    <form method="GET" action="{{ route('panitia.byProposal', $proposal->id_proposal) }}">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau jabatan..." class="filter-proposal-input">
        <button type="submit" class="filter-proposal-button">Terapkan</button>
    </form>

    <a href="{{ $routeTambahPanitia }}">+ Tambah Panitia</a><br><br>

    @if ($panitias->count())
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @php
                $isAdmin = auth('admin')->check();
                $isPanitiaSuper = auth('panitia')->check() && in_array(
                    strtolower(auth('panitia')->user()->jabatan_panitia),
                    ['ketua', 'sekretaris', 'bendahara']
                );
            @endphp
                @foreach ($panitias as $p)
                    <tr>
                        <td>{{ $p->nama_panitia }}</td>
                        <td>{{ $p->jabatan_panitia }}</td>
                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{$p->email}}</td>
                        <td>
                            @if ($isAdmin)
                                <a href="{{ route('panitia.edit', $p->id_panitia) }}">Edit</a>
                                <form action="{{ route('panitia.destroy', $p->id_panitia) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin?')" type="submit">Hapus</button>
                                </form>
                            @elseif ($isPanitiaSuper)
                                <a href="{{ route('panitia.Superedit', $p->id_panitia) }}">Edit</a>
                                <form action="{{ route('panitia.Superdestroy', $p->id_panitia) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin?')" type="submit">Hapus</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $panitias->links() }}
    @else
        <p>Belum ada panitia untuk acara ini.</p>
    @endif

    <a href="{{ $routeBack }}">⬅ Kembali ke Detail Proposal</a>
     -->

     <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Panitia untuk {{ $proposal->nama_acara }}</h1>
        </div>
    </div>

     <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('panitia.byProposal', $proposal->id_proposal) }}">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau jabatan..." class="filter-proposal-input">
                            <button type="submit" class="filter-proposal-button">Cari</button>
                        </form>
                        <div class="table-responsive mt-5">
                        @if ($panitias->count())
                            <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $isAdmin = auth('admin')->check();
                                        $isPanitiaSuper = auth('panitia')->check() && in_array(
                                            strtolower(auth('panitia')->user()->jabatan_panitia),
                                            ['ketua', 'sekretaris', 'bendahara']
                                        );
                                    @endphp
                                    @foreach ($panitias as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_panitia }}</td>
                                        <td>{{ $p->jabatan_panitia }}</td>
                                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                                        <td>{{$p->email}}</td>
                                        <td>
                                            @if ($isAdmin)
                                                <a href="{{ route('panitia.edit', $p->id_panitia) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                <form action="{{ route('panitia.destroy', $p->id_panitia) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                        <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                    </button>
                                                </form>
                                            @elseif ($isPanitiaSuper)
                                                <a href="{{ route('panitia.Superedit', $p->id_panitia) }}" class="btn btn-primary btn-sm rounded-11 me-2" data-bs-toggle="tooltip" data-bs-original-title="Edit" style="height: 30px;"><i class="fe fe-edit" style="font-size: 16px;"></i></a>
                                                <form action="{{ route('panitia.Superdestroy', $p->id_panitia) }}" method="POST" data-bs-original-title="Hapus" class="form-konfirmasi" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-11" style="height: 30px;">
                                                        <i class="fe fe-trash-2" style="font-size: 16px; color: white;"></i>
                                                    </button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $panitias->links() }}
                            @else
                                <p>Belum ada panitia untuk acara ini.</p>
                            @endif
                            <a href="{{ $routeBack }}" class="btn btn-danger btn-icon text-white me-2">
                                Kembali Ke Detail Proposal
                            </a>
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