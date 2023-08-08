@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Surat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Surat Keterangan Usaha</div>
                            <div class="text-xs font-weight-bold text-primary text-right mt-3 text-uppercase mb-1">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#sku">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Surat Keterangan Miskin</div>
                            <div class="text-xs font-weight-bold text-primary text-right mt-3 text-uppercase mb-1">
                                <button class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Surat Keterangan Tidak Mampu</div>
                            <div class="text-xs font-weight-bold text-primary text-right mt-3 text-uppercase mb-1">
                                <button class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Surat Keterangan Domisili</div>
                            <div class="text-xs font-weight-bold text-primary text-right mt-3 text-uppercase mb-1">
                                <button class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Surat Keterangan</div>
                            <div class="text-xs font-weight-bold text-primary text-right mt-3 text-uppercase">
                                <button class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="sku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Surat Keterangan Usaha</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('surat.create', 'surat-keterangan-usaha') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Nama Usaha</label>
                                        <input type="text" class="form-control" required name="nama_usaha">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Keperluan</label>
                                        <input type="text" class="form-control" required name="keperluan">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Lokasi Usaha</label>
                                        <input type="text" class="form-control" required
                                            placeholder="Contoh : Banjar Dinas Bubungkelambu, Desa Batur Tengah"
                                            name="lokasi_usaha">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Download</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
