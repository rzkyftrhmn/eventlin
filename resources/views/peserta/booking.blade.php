@extends('peserta.dashboard')

@section('content')

<div class="home-event">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-event">
                    <div class="home-title">
                        <h3>Event Saya</h3>
                    </div>
                    <div class="title-home-event d-flex">
                        <a href="{{ route('peserta.content_dashboard') }}">
                            <img src="{{ asset('assets/img-peserta/home.png')}}" height="23" alt="">
                        </a>
                        <p>/ Event Saya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <table class="table">
      <thead class="table-light">
        <tr>
            <th>No</th>
            <th>test1</th>
            <th>aaa</th>
            <th>aasa</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
            <td>koko</td>
            <td>aaa</td>
            <td>qwewqe</td>
        </tr>
        <tr>
            <td>2</td>
            <td>koko</td>
            <td>aaa</td>
            <td>qwewqe</td>
        </tr>
        <tr>
            <td>3</td>
            <td>koko</td>
            <td>aaa</td>
            <td>qwewqe</td>
        </tr>
        <tr>
            <td>4</td>
            <td>koko</td>
            <td>aaa</td>
            <td>qwewqe</td>
        </tr>
        <tr>
            <td>5</td>
            <td>koko</td>
            <td>aaa</td>
            <td>qwewqe</td>
        </tr>
        <tr>
            <td>6</td>
            <td>koko</td>
            <td>aaa</td>
            <td>qwewqe</td>
        </tr>
      </tbody>
    </table>
</div>

@endsection