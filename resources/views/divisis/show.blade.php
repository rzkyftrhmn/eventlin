@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Divisi</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Nama Divisi :</td>
                                    <td>{{ $divisi->nama_divisi }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Tugas Divisi :</td>
                                    <td>{{ $divisi->list_tugas_divisi }}</td>
                                </tr>
                            </tbody>   
                        </table>   
                    </div>   

                    <a href="{{ route('divisis.index') }}" class="btn btn-primary">Kembali ke daftar divisi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
