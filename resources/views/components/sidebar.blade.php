<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    {{-- {{ dd(Auth()->user()) }} --}}
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo.png') }}" alt="" width="50px">
        </div>
    </a>
    <div class=" text-white text-center mx-3 mb-3">Sistem Informasi Desa Batur</div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{ request()->is('/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item  {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-home"></i>
            <span>Home Page</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @if (Auth()->user()->id_jabatan === 1)
        <!-- Heading -->
        <div class="sidebar-heading">
            Fitur Admin
        </div>

        <li class="nav-item {{ request()->is('admin/pegawai*') ? 'active' : '' }}">
            {{-- <a class="nav-link collapsed " href="{{ route('pengguna.index') }}">
            <i class="fas fa-user"></i>
            <span>Pegawai</span>
        </a> --}}
        </li>

        <li class="nav-item {{ request()->is('admin/jabatan*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('jabatan.index') }}">
                <i class="fas fa-user-secret"></i>
                <span>Jabatan</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('pengguna.index') }}">
                <i class="fas fa-user"></i>
                <span>Pengguna</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/kadus*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('kadus.index') }}">
                <i class="fas fa-street-view"></i>
                <span>Data Perangkat Desa</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/akta-kawin*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('akta-kawin.index') }}">
                <i class="fas fa-file-alt"></i>
                <span>Akta Kawin</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/keluarga*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('keluarga.index') }}">
                <i class="fas fa-user-tie"></i>
                <span>Kepala Keluarga</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/penduduk*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('penduduk.index') }}">
                <i class="fas fa-users"></i>
                <span>Penduduk</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/wilayah*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('wilayah.index') }}">
                <i class="fas fa-map-marker-alt"></i>
                <span>Wilayah GIS</span>
            </a>
        </li>

        <div class="sidebar-heading">
            Fitur Admin Surat
        </div>

        <li class="nav-item {{ request()->is('admin/Adminlist*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('surat.Adminlist') }}">
                <i class="fas fa-file"></i>
                <span>Surat Konfirmasi</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/surat') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('admin.suratAdmin') }}">
                <i class="far fa-file-word"></i>
                <span>Cetak Surat</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/surat/list*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('admin.list') }}">
                <i class="far fa-file-word"></i>
                <span>List Surat</span>
            </a>
        </li>
    @endif

    {{-- 3 => kelian banjar --}}
    {{-- 4 => Perbekel --}}
    {{-- 5 => Staf --}}
    @if (in_array(Auth()->user()->id_jabatan, [3, 4, 5, 6]))
        <div class="sidebar-heading">
            Fitur Admin Surat
        </div>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('profile') }}">
                <i class="far fa-user"></i>
                <span>Profile</span>
            </a>
        </li>



        <li class="nav-item {{ request()->is('admin/Adminlist*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('surat.Adminlist') }}">
                <i class="fas fa-file"></i>
                <span>Surat Konfirmasi</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/surat') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('admin.suratAdmin') }}">
                <i class="far fa-file-word"></i>
                <span>Cetak Surat</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/surat/list*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('admin.list') }}">
                <i class="far fa-file-word"></i>
                <span>List Surat</span>
            </a>
        </li>
    @endif

    {{-- masyarakat --}}
    @if (Auth()->user()->id_jabatan === 2)
        <!-- Heading -->
        <div class="sidebar-heading">
            Fitur User
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('profile') }}">
                <i class="far fa-user"></i>
                <span>Profile</span>
            </a>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('surat') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('surat.index') }}">
                <i class="far fa-file-word"></i>
                <span>Cetak Surat</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('surat/list*') ? 'active' : '' }}">
            <a class="nav-link collapsed " href="{{ route('surat.list') }}">
                <i class="far fa-file-word"></i>
                <span>List Surat</span>
            </a>
        </li>
    @endif


    <li class="nav-item">
        <a class="nav-link collapsed " href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt "></i>
            Logout
        </a>

    </li>


</ul>
