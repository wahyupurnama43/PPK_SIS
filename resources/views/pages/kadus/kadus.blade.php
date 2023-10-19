@extends('layouts.app')
@section('title', 'Kadus')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Kadus & Perbekel</h6>
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
                            <th>Email</th>
                            <th>Nama Kadus/Perbekel</th>
                            <th>Jabatan</th>
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
    <div class="modal fade" id="wilayah"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('kadus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kadus & Perbekel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kadus">Nama Kadus/Perbekel</label>
                                    <input type="text" class="form-control" id="kadus" name="kadus"
                                        placeholder="Masukan Nama Kadus/Perbekel" value="{{ old('kadus') }}">
                                    @error('kadus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukan Nama email/Perbekel" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kadus">Pilih Akun</label>
                                    <select name="id_pengguna" id="id_pengguna" class="form-control select50">
                                        <option value="" selected disabled>Pilih Akun</option>
                                        @foreach ($pengguna as $pg)
                                            <option value="{{ $pg->id }}">{{ $pg->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pengguna')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="form-control ">
                                        <option value="" selected disabled>Pilih Jabatan</option>
                                        @foreach ($jabatan as $jbt)
                                            <option value="{{ $jbt->uuid }}">{{ $jbt->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('jabatan')
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
    <div class="modal fade" id="editWilayah"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="" id="form" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kadus</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kadus">Nama Kadus/Perbekel</label>
                                    <input type="text" class="form-control" id="kadusE" name="kadus"
                                        placeholder="Masukan Nama Kadus/Perbekel" value="{{ old('kadus') }}">
                                    @error('kadus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="emailE" name="email"
                                    placeholder="Masukan Nama email/Perbekel" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kadus">Pilih Akun</label>
                                    <select name="id_pengguna" id="id_penggunaE" class="select50">
                                        @foreach ($pengguna as $pg)
                                            <option value="{{ $pg->id }}">{{ $pg->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pengguna')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatanE" class="form-control">
                                        @foreach ($jabatan as $jbt)
                                            <option value="{{ $jbt->uuid }}">{{ $jbt->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('jabatan')
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".select50").select2({})

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kadus.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pengguna.username',
                        name: 'pengguna.username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jabatan.nama',
                        name: 'jabatan.nama'
                    },
                    {
                        data: 'dusun',
                        name: 'dusun'
                    },
                    {
                        data: 'desa',
                        name: 'desa'
                    },
                    {
                        data: 'kecamatan',
                        name: 'kecamatan'
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
                    $('#kadusE').val(res.nama);
                    $('#id_penggunaE').val(res.id_pengguna);
                    $('#jabatanE').val(res.jabatan.uuid);
                    $('#dusunE').val(res.dusun);
                    $('#desaE').val(res.desa);
                    $('#emailE').val(res.email);
                    $('#kecamatanE').val(res.kecamatan);
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
