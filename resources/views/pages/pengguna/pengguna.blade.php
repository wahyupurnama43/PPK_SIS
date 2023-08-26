@extends('layouts.app')
@section('title', 'Pengguna')

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
            <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
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
                            <th>Username</th>
                            <th>Jabatan</th>
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
                <form action="{{ route('pengguna.store') }}" method="post" enctype="multipart/form-data" name="myform">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Masukkan Username" value="{{ old('username') }}">
                                    @error('kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" required class="form-control">
                                        <option value="">Pilih jabatan</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->uuid }}">
                                                {{ $j->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Masukkan password" value="{{ old('password') }}">
                                    <div class="mt-2 d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" id="generate">Generate </button>
                                        <button type="button" class="btn btn-info" id="copy">Copy </button>
                                    </div>
                                    @error('password')
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

    {{--  Modal Edit   --}}
    <div class="modal fade" id="editWilayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="" id="formE" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengguna</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="usernameE" name="username"
                                        placeholder="Masukan username" value="{{ old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatanE" class="form-control">
                                        <option value="" selected disabled>Pilih Jabatan</option>
                                        @foreach ($jabatan as $jb)
                                            <option value="{{ $jb->uuid }}">
                                                {{ $jb->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_hp">No Handphone</label>
                                    <input type="text" class="form-control" id="no_hpE" name="no_hp"
                                        placeholder="Masukan No Handphone" value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="passwordE" name="password"
                                        placeholder="Masukkan password" value="{{ old('password') }}">
                                    <div class="mt-2 d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" id="generateEdit">Generate </button>
                                        <button type="button" class="btn btn-info" id="copyEdit">Copy </button>
                                    </div>
                                    @error('password')
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
                    ajax: "{{ route('pengguna.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'jabatan.nama',
                            name: 'jabatan.nama'
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
        $('#generate').click(function() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";
            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber + 1);
            }
            $('#password').val(password)
        })

        $('#copy').click(function() {
            var copyText = document.getElementById("password");
            copyText.select();
            document.execCommand("copy");
        })

        $('#generateEdit').click(function() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";
            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber + 1);
            }
            $('#passwordE').val(password);
        })

        $('#copyEdit').click(function() {
            var copyText = document.getElementById("passwordE");
            copyText.select();
            document.execCommand("copy");
        })
    </script>

    <script>
        $(document).on('click', '.update', function(event) {
            let url = $(this).attr('data-url');
            let send = $(this).attr('data-send');
            $.ajax({
                url: url,
                // return the result
                success: function(res) {
                    $('#formE').attr('action', send);
                    $('#usernameE').val(res.username);
                    $('#jabatanE').val(res.jabatan.uuid);
                    $('#no_hpE').val(res.no_hp);
                    $('#passwordE').val('');
                    $('#generateEdit').prop('disabled', false); 
                    $('#copyEdit').prop('disabled', false); 
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
