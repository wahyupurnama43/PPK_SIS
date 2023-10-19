@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <form action="{{ route('profile.updatePassword') }}" method="POST">
            <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Masuk Aplikasi</h6>
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary">
                    Edit Data
                </button>
            </div>

            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}"
                                readonly>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Penduduk {{ ucwords($penduduk->nama_lengkap) }}</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nik">Nik</label>
                        <input type="text" class="form-control" readonly name="nik" readonly
                            value="{{ $penduduk->nik }}">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_akta_lahir">No Akta Lahir</label>
                        <input type="text" class="form-control" name="no_akta_lahir" readonly
                            value="{{ $penduduk->no_akta_lahir }}">
                        @error('no_akta_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_lengkap_ayah">Nama Lengkap Ayah</label>
                        <input type="text" class="form-control" readonly name="nama_lengkap_ayah"
                            value="{{ $penduduk->nama_lengkap_ayah }}">
                        @error('nama_lengkap_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_lengkap_ibu">Nama Lengkap Ibu</label>
                        <input type="text" class="form-control" readonly name="nama_lengkap_ibu"
                            value="{{ $penduduk->nama_lengkap_ibu }}">
                        @error('nama_lengkap_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="kk">No KK</label>
                        <br>
                        <input type="text" class="form-control" value="{{ $penduduk->keluarga->no_kk }}" readonly>
                        @error('kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <br>
                        <input type="text" class="form-control" name="nama_lengkap" readonly
                            value="{{ $penduduk->nama_lengkap }}">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <br>
                        <input type="text" readonly class="form-control"
                            value="{{ $penduduk->jenis_kelamin === 'L' ? 'Laki Laki' : 'Perempuan' }}">
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <br>
                        <input type="text" class="form-control" name="tempat_lahir" readonly
                            value="{{ $penduduk->tempat_lahir }}">

                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <br>
                        <input type="date" class="form-control" name="tanggal_lahir" readonly
                            value="{{ $penduduk->tanggal_lahir }}">

                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <br>
                        @php
                            if ($penduduk->agama == 'H') {
                                $penduduk->agama = 'Hindu';
                            } elseif ($penduduk->agama == 'I') {
                                $penduduk->agama = 'Islam';
                            } elseif ($penduduk->agama == 'P') {
                                $penduduk->agama = 'Protestan';
                            } elseif ($penduduk->agama == 'KA') {
                                $penduduk->agama = 'Katolik';
                            } elseif ($penduduk->agama == 'B') {
                                $penduduk->agama = 'Budha';
                            } elseif ($penduduk->agama == 'Kh') {
                                $penduduk->agama = 'Khonghucu';
                            }
                        @endphp
                        <input type="text" value="{{ $penduduk->agama }}" class="form-control" readonly>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="golongan_darah">Golongan Darah</label>
                        <br>
                        <input type="text" class="form-control" name="golongan_darah" readonly
                            value="{{ $penduduk->golongan_darah }}">

                        @error('golongan_darah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan</label>
                        <br>

                        @foreach ($pendidikan as $pen)
                            @if ($penduduk->pendidikan === $pen->pendidikan)
                                <input type="text" readonly class="form-control" value="  {{ $pen->pendidikan }}">
                            @endif
                        @endforeach

                        @error('pendidikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="status_dalam_keluarga">Status Dalam Keluarga</label>
                        <br>
                        <input type="text" class="form-control" value="{{ $penduduk->status_dalam_keluarga }}"
                            readonly>
                        @error('status_dalam_keluarga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="status_kawin">Status Kawin</label>
                        <br>
                        <input type="text" class="form-control" value="{{ $penduduk->status_kawin }}" readonly>

                        @error('status_kawin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="aktaKawin">No Akta Kawin</label>
                        <br>
                        <input type="text" class="form-control"
                            value="{{ !empty($penduduk->aktaKawin->uuid) ? $penduduk->aktaKawin->uuid : '' }}" readonly>

                        @error('aktaKawin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <br>
                        @foreach ($pekerjaan as $kerja)
                            @if ($penduduk->id_pekerjaan === $kerja->id)
                                <input type="text" readonly class="form-control" value="{{ $kerja->pekerjaan }}">
                            @endif
                        @endforeach

                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="pekerjaan">Alamat</label>
                        <br>
                        <input class="form-control" type="text" disabled
                            value="{{ Str::title($penduduk->keluarga->alamat) . ', ' . Str::title($penduduk->keluarga->dusun) . ', ' . Str::title($penduduk->keluarga->desa) . ', ' . Str::title($penduduk->keluarga->kecamatan) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
