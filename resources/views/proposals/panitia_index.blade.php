@extends('layouts.app')

@section('content')
    <h2>Proposal yang Anda Ikuti sebagai Panitia</h2>

    @if ($proposals->count() > 0)
        <ul>
            @foreach ($proposals as $proposal)
                <li>
                    <a href="{{ route('proposals.show', $proposal->id_proposal) }}">
                        {{ $proposal->nama_acara }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Anda belum tergabung dalam proposal manapun.</p>
    @endif
@endsection
