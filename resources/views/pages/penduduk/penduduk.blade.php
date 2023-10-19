@extends('layouts.app')
@section('title', 'Penduduk')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2 {
            width: 100% !important;
        }

        td {
            text-transform: capitalize !important;
        }
    </style>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
            <!-- Button trigger modal -->
            <div class="d-flex">
                <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#wilayah">
                    Tambah Data
                </button>
                <a href="{{ route('export') }}" class="btn btn-success mr-3">Export Excel</a>
                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#export">Import
                    Excel</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>No KK</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Pendidikan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="wilayah" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('penduduk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nik">Nik</label>
                                    <input type="text" class="form-control" required name="nik"
                                        value="{{ old('nik') }}">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_akta_lahir">No Akta Lahir</label>
                                    <input type="text" class="form-control" required name="no_akta_lahir"
                                        value="{{ old('no_akta_lahir') }}">
                                    @error('no_akta_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_lengkap_ayah">Nama Lengkap Ayah</label>
                                    <input type="text" class="form-control" required name="nama_lengkap_ayah"
                                        value="{{ old('nama_lengkap_ayah') }}">
                                    @error('nama_lengkap_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_lengkap_ibu">Nama Lengkap Ibu</label>
                                    <input type="text" class="form-control" required name="nama_lengkap_ibu"
                                        value="{{ old('nama_lengkap_ibu') }}">
                                    @error('nama_lengkap_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kk">No KK</label>
                                    <br>
                                    <select id="kk" data-placeholder="Pilih KK" name="kk">
                                        <option></option>
                                    </select>

                                    @error('kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <br>
                                    <input type="text" class="form-control" name="nama_lengkap" required
                                        value="{{ old('nama_lengkap') }}">

                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <br>
                                    <select class="select50" name="jenis_kelamin">
                                        <option selected disabled>Pilih jenis kelamin</option>
                                        <option value="L">Laki Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>

                                    @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <br>
                                    <input type="text" class="form-control" name="tempat_lahir" required
                                        value="{{ old('tempat_lahir') }}">

                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <br>
                                    <input type="date" class="form-control" name="tanggal_lahir" required
                                        value="{{ old('tanggal_lahir') }}">

                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <br>
                                    <select class="select50" name="agama">
                                        <option selected disabled>Pilih Agama</option>
                                        <option value="I">Islam</option>
                                        <option value="H">Hindu</option>
                                        <option value="KR">Kristen</option>
                                        <option value="KA">Katolik</option>
                                        <option value="B">Budha</option>
                                        <option value="Kh">Khonghucu</option>
                                    </select>

                                    @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="golongan_darah">Golongan Darah</label>
                                    <br>
                                    <input type="text" class="form-control" name="golongan_darah" required
                                        value="{{ old('golongan_darah') }}">

                                    @error('golongan_darah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan</label>
                                    <br>
                                    <select class="select50" name="pendidikan">
                                        <option selected disabled>Pilih Pendidikan</option>
                                        @foreach ($pendidikan as $pen)
                                            <option value="{{ $pen->pendidikan }}">{{ $pen->pendidikan }}</option>
                                        @endforeach
                                    </select>

                                    @error('pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status_dalam_keluarga">Status Dalam Keluarga</label>
                                    <br>
                                    <select class="select50" name="status_dalam_keluarga">
                                        <option selected disabled>Pilih Status Dalam Keluarga</option>
                                        <option value="anak">Anak</option>
                                        <option value="kepala keluarga">Kepala Keluarga</option>
                                        <option value="ibu">Ibu</option>
                                        <option value="orang tua">Orang tua</option>
                                        <option value="famili lain">Famili Lain </option>
                                    </select>

                                    @error('status_dalam_keluarga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status_kawin">Status Kawin</label>
                                    <br>
                                    <select class="select50" name="status_kawin">
                                        <option selected disabled>Pilih Status Kawin</option>
                                        <option value="belum kawin">Belum Kawin</option>
                                        <option value="kawin">Kawin</option>
                                        <option value="cerai hidup">Cerai Hidup</option>
                                        <option value="cerai mati">Cerai Mati</option>
                                    </select>

                                    @error('status_kawin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="aktaKawin">No Akta Kawin</label>
                                    <br>
                                    <select id="aktaKawin" data-placeholder="Pilih No Akta Kawin" name="aktaKawin">
                                        <option></option>
                                    </select>

                                    @error('aktaKawin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <br>
                                    <select class="select50" name="pekerjaan">
                                        <option selected disabled>Pilih Pekerjaan</option>
                                        @foreach ($pekerjaan as $kerja)
                                            <option value="{{ $kerja->uuid }}">{{ $kerja->pekerjaan }}</option>
                                        @endforeach
                                    </select>

                                    @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editWilayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="" id="form" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Akta Kawin</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="aktaKawin">No Akta Kawin</label>
                                <input type="text" class="form-control" id="aktaKawinE" name="aktaKawin"
                                    placeholder="Enter No Akta Kawin" value="{{ old('aktaKawin') }}">
                                @error('aktaKawin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="export" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('import') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Import</h5>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="excel" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select50").select2({})


            $("#kk").select2({
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('api.kk') }}",
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

            $("#aktaKawin").select2({
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('api.aktaKawin') }}",
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

        });
    </script>

    <script>
        @if (count($errors) > 0)
            $('#wilayah').modal('show');
        @endif
    </script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('penduduk.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'keluarga.no_kk',
                        name: 'keluarga.no_kk'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },

                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        "render": function(data, type, row) {
                            if (data === 'L') {
                                return 'Laki - Laki';
                            } else {
                                return 'Perempuan';
                            }
                        },
                    },
                    {
                        data: 'infolahir',
                        name: 'infolahir',
                        searchable: false
                    },
                    {
                        data: 'pendidikan',
                        name: 'pendidikan',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false
                    },
                ]
            });
        });
    </script>

    <script>
        $(document).on('click', '.deletePost', function(event) {
            let url = $(this).attr('data-url');
            let id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Yakin Data Di Hapus ?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function(res) {
                        if (res) {
                            Toastify({
                                text: 'Data Berhasil Dihapus',
                                className: "success",
                                style: {
                                    background: "#00b09b",
                                }
                            }).showToast();
                        }
                        location.reload();
                    }
                });
            }
        });
    </script>
@endsection
