@extends('layouts.app')

@section('title', 'Surat')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

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
                    <form method="POST" action="{{ route('admin.storeSuratAdmin', 'surat-keterangan-usaha') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Nik</label>
                                        <select name="nik" id="nik"  data-placeholder="Pilih Nik"></select>
                                    </div>
                                </div>

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


@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#nik").select2({
            dropdownParent: $('#sku'),
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('api.nik') }}",
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                data: function(term) {
                    return {
                        term: term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
