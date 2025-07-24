@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Profile Panitia</h1>
        </div>
    </div>

    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xl-6">
                                <div class="wideget-user-desc d-sm-flex">
                                    <div class="wideget-user-img">
                                        <img src="{{ asset('assets/images/panitia.png') }}" height="100" alt="img">
                                    </div>
                                    <div class="user-wrap">
                                        <h4>{{ $panitia->nama_panitia }}</h4>
                                        <h6 class="text-muted mb-3">Terdaftar Sejak: {{ $panitia->created_at }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#tab-51" class="active show" data-bs-toggle="tab">Profile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="tab-51">
                    <div id="profile-log-switch">
                        <div class="card">
                            <div class="card-body">
                                <div class="media-heading">
                                    <h5><strong>Informasi Pribadi</strong></h5>
                                </div>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>Name :</strong> {{ $panitia->nama_panitia }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email :</strong> {{ $panitia->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jabatan :</strong> {{ $panitia->jabatan_panitia }}</td>
                                            </tr>
                                        </tbody>
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>Divisi :</strong> {{ $panitia->divisi->nama_divisi ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Proposal / Acara :</strong> {{ $panitia->proposal->nama_acara ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="row profie-img">
                                    <div class="col-md-12">
                                        <div class="media-heading">
                                            <h5><strong>Biography</strong></h5>
                                        </div>
                                        <p>
                                            Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus</p>
                                        <p class="mb-0">because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter but because those who do not know how to pursue consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
