@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Surat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @foreach ($surat as $surat)
            <div class="col-lg-4 col-12">
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
                            @if ($surat->verifikasi_kadus === 1 || $surat->verifikasi_staf === 1 && $surat->verifikasi_staf !== 0 && $surat->verifikasi_kadus !== 0 )
                                <button class="btn btn-primary">Preview</button>
                                @if ($surat->verifikasi_kadus === 1 && $surat->verifikasi_staf === 1)
                                    <button class="btn btn-success">Download</button>
                                @endif
                            @elseif($surat->verifikasi_kadus === 0 || $surat->verifikasi_staf === 0)
                                <span class="badge badge-danger p-2"> Di Tolak</span>
                            @else
                                <button class="btn btn-info">Edit</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
