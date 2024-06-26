@extends('layouts.app')
@section('title', 'Wilayah')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        td {
            text-transform: capitalize !important;
        }
    </style>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Kepala Keluarga</h6>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#wilayah">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Kartu Keluarga</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>Alamat</th>
                            <th>Dusun</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
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
    <div class="modal fade" id="wilayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('keluarga.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akta Kawin</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kk">No Kartu Keluarga</label>
                                    <input type="text" class="form-control" id="kk" name="kk"
                                        placeholder="Masukkan No Kartu Keluarga" value="{{ old('kk') }}">
                                    @error('kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nama_kepala_keluarga"
                                        name="nama_kepala_keluarga" placeholder="Masukkan No Akta Kawin"
                                        value="{{ old('nama_kepala_keluarga') }}">
                                    @error('nama_kepala_keluarga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Masukkan Alamat" value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dusun">Dusun</label>
                                    <input type="text" class="form-control" id="dusun" name="dusun"
                                        placeholder="Masukkan Dusun" value="{{ old('dusun') }}">
                                    @error('dusun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="desa">Desa</label>
                                    <input type="text" class="form-control" id="desa" name="desa"
                                        placeholder="Masukkan Desa" value="{{ old('desa') }}">
                                    @error('desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                        placeholder="Masukkan Kecamatan" value="{{ old('kecamatan') }}">
                                    @error('kecamatan')
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
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kk">No Kartu Keluarga</label>
                                    <input type="text" class="form-control" id="kkE" name="kk"
                                        placeholder="Masukkan No Kartu Keluarga" value="{{ old('kk') }}">
                                    @error('kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nama_kepala_keluargaE"
                                        name="nama_kepala_keluarga" placeholder="Masukkan No Akta Kawin"
                                        value="{{ old('nama_kepala_keluarga') }}">
                                    @error('nama_kepala_keluarga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamatE" name="alamat"
                                        placeholder="Masukkan Alamat" value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dusun">Dusun</label>
                                    <input type="text" class="form-control" id="dusunE" name="dusun"
                                        placeholder="Masukkan Dusun" value="{{ old('dusun') }}">
                                    @error('dusun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="desa">Desa</label>
                                    <input type="text" class="form-control" id="desaE" name="desa"
                                        placeholder="Masukkan Desa" value="{{ old('desa') }}">
                                    @error('desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatanE" name="kecamatan"
                                        placeholder="Masukkan Kecamatan" value="{{ old('kecamatan') }}">
                                    @error('kecamatan')
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


@endsection

@section('js')
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
                ajax: "{{ route('keluarga.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_kk',
                        name: 'no_kk'
                    },
                    {
                        data: 'nama_kepala_keluarga',
                        name: 'nama_kepala_keluarga'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                    },
                    {
                        data: 'dusun',
                        name: 'dusun',
                    },
                    {
                        data: 'desa',
                        name: 'desa',
                    },
                    {
                        data: 'kecamatan',
                        name: 'kecamatan',
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>

    <script>
        $(document).on('click', '.update', function(event) {
            let url = $(this).attr('data-url');
            let send = $(this).attr('data-send');
            $.ajax({
                url: url,
                // return the result
                success: function(res) {
                    $('#form').attr('action', send);
                    $('#kkE').val(res.no_kk);
                    $('#nama_kepala_keluargaE').val(res.nama_kepala_keluarga);
                    $('#dusunE').val(res.dusun);
                    $('#desaE').val(res.desa);
                    $('#kecamatanE').val(res.kecamatan);
                    $('#alamatE').val(res.alamat);
                },
            })
        });

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

    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#wilayah').modal('show');
        @endif
    </script>


@endsection
