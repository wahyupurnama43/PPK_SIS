@extends('layouts.app')
@section('title', 'Surat')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data List Surat</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengaju</th>
                            <th>Nomor Surat</th>
                            <th>Wilayah</th>
                            <th>Jenis Surat</th>
                            <th>Verifikasi Kadus</th>
                            <th>Verifikasi Perbekel</th>
                            <th>PDF</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                ajax: "{{ route('surat.Adminlist') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'penduduk.nama_lengkap',
                        name: 'penduduk.nama_lengkap'
                    },
                    {
                        data: 'nomor_surat',
                        name: 'nomor_surat'
                    },
                    {
                        data: 'dusun',
                        name: 'dusun'
                    },
                    {
                        data: 'jenis_surat.nama',
                        name: 'jenis_surat.nama'
                    },
                    {
                        data: 'verifikasi_kadus',
                        name: 'verifikasi_kadus'
                    },
                    {
                        data: 'verifikasi_perbekel',
                        name: 'verifikasi_perbekel'
                    },{
                        data: 'preview',
                        name: 'preview'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>

    {{-- <script>
        $(document).on('click', '.update', function(event) {
            let url = $(this).attr('data-url');
            let send = $(this).attr('data-send');
            $.ajax({
                url: url,
                // return the result
                success: function(res) {
                    $('#form').attr('action', send);
                    $('#kadusE').val(res.nama);
                    $('#jabatanE').val(res.jabatan.uuid);
                    $('#dusunE').val(res.dusun);
                    $('#desaE').val(res.desa);
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
    </script> --}}
{{-- 
    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#wilayah').modal('show');
        @endif
    </script> --}}


@endsection
