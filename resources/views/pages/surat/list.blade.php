@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Surat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @foreach ($surats as $surat)
            <div class="col-lg-4 col-12 mb-3">
                <div class="card p-3">
                    <div class="d-flex flex-column">
                        <table>
                            <tr>
                                <td>Jenis Surat</td>
                                <td>:</td>
                                <td>{{ $surat->jenis_surat->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Surat</td>
                                <td>:</td>
                                <td>{{ $surat->no_surat->kode . '/' . $surat->no_surat->urutan . '/' . $surat->no_surat->bulan . '/' . $surat->no_surat->tahun }}
                                </td>
                            </tr>
                            <tr>
                                <td>Pengaju</td>
                                <td>:</td>
                                <td>{{ $surat->penduduk->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    @if ($surat->verifikasi_kadus === 1 && $surat->verifikasi_staf === 1)
                                        <span class="badge badge-success p-2"> Verifikasi</span>
                                    @elseif($surat->verifikasi_kadus === 0 || $surat->verifikasi_staf === 0)
                                        <span class="badge badge-danger p-2"> Di Tolak</span>
                                    @else
                                        <span class="badge badge-warning p-2"> Menunggu Verifikasi</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <div class="mt-4">
                            {{-- @if ($surat->verifikasi_kadus === 1 || ($surat->verifikasi_staf === 1 && $surat->verifikasi_staf !== 0 && $surat->verifikasi_kadus !== 0))
                                <button class="btn btn-primary">Preview</button> --}}
                            @if ($surat->verifikasi_kadus === 1 && $surat->verifikasi_staf === 1)
                                <a href="{{ Storage::url($surat->pdf) }}" target="_blank" class="btn btn-success">Unduh</a>
                            @endif
                            {{-- @elseif($surat->verifikasi_kadus === 0 || $surat->verifikasi_staf === 0)
                                <span class="badge badge-danger p-2"> Di Tolak</span> --}}
                            {{-- @else
                                <button class="btn btn-info" data-toggle="modal" data-target="#sku{{ $surat->uuid }}">Edit</button>

                                <div class="modal fade" id="sku{{ $surat->uuid }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mengubah Surat Keterangan Usaha</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('surat.update', $surat->uuid) }}">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            Deskripsi Saat ini:
                                                            {{ $surat->deskripsi }}
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Mengubah Nama Usaha </label>
                                                                <input type="text" class="form-control" required
                                                                    name="nama_usaha" >
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Mengubah Keperluan</label>
                                                                <input type="text" class="form-control" required
                                                                    name="keperluan">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Mengubah Lokasi Usaha</label>
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
                                </div> --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $surats->links() }}
        </div>




@endsection
