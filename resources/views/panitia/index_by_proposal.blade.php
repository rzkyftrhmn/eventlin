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
    <h2>Daftar Panitia untuk {{ $proposal->nama_acara }}</h2>

    <form method="GET" action="{{ route('panitia.byProposal', $proposal->id_proposal) }}">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau jabatan...">
        <button type="submit">Cari</button>
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
    

@endsection
