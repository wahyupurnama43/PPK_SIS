@extends('layouts.app')
@section('title', 'Detail Penduduk')

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
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Penduduk {{ $penduduk->nama_lengkap }}</h6>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#wilayah">
                Edit Data
            </button>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nik">Nik</label>
                    <input type="text" class="form-control" required name="nik"
                        value="{{ $penduduk->nik }}">
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
                        <option>{{ $penduduk->keluarga->no_kk }}</option>
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
                        <option value="P">Protestan</option>
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
                        <option value="BS">Belum Sekolah</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="D1">Diploma 1 </option>
                        <option value="D2">Diploma 2 </option>
                        <option value="D3">Diploma 3 </option>
                        <option value="D4">Diploma 4 </option>
                        <option value="S1">Strata 1</option>
                        <option value="S2">Strata 2</option>
                        <option value="S3">Strata 3</option>
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
    </div>
@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
// In your Javascript (external .js resource or <script> tag)
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
@endsection