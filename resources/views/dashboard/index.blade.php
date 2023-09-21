@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div>
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Permintaan Surat</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $permintaan_surat }}</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              jumlah penduduk</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_penduduk }}</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Surat Terverifikasi
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                  {{ number_format(($surat_terverifikasi / $permintaan_surat) * 100, 2) }}%
                                  </div>
                              </div>
                              <div class="col">
                                  <div class="progress progress-sm mr-2">
                                      <div class="progress-bar bg-info" role="progressbar"
                                          style="width: {{ ($surat_terverifikasi / $permintaan_surat) * 100 }}%" 
                                          aria-valuenow="{{ ($surat_terverifikasi / $permintaan_surat) * 100 }}" 
                                          aria-valuemin="0"
                                          aria-valuemax="100"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-check fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                              Jumlah Data Pegawai</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_data_pegawai }}</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-user-edit fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection