<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
    <li class="nav-item  {{ (request()->is('/')) ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Admin
    </div>

    <li class="nav-item {{ (request()->is('admin/pegawai*')) ? 'active' : '' }}">
        {{-- <a class="nav-link collapsed " href="{{ route('pengguna.index') }}">
            <i class="fas fa-user"></i>
            <span>Pegawai</span>
        </a> --}}
    </li>

    <li class="nav-item {{ (request()->is('admin/akta-kawin*')) ? 'active' : '' }}">
        <a class="nav-link collapsed " href="{{ route('akta-kawin.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Akta Kawin</span>
        </a>
    </li>

    <li class="nav-item {{ (request()->is('admin/penduduk*')) ? 'active' : '' }}">
        <a class="nav-link collapsed " href="{{ route('penduduk.index') }}">
            <i class="fas fa-users"></i>
            <span>Penduduk</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ (request()->is('admin/wilayah*')) ? 'active' : '' }}">
        <a class="nav-link collapsed " href="{{ route('wilayah.index') }}">
            <i class="fas fa-map-marker-alt"></i>
            <span>Wilayah GIS</span>
        </a>
    </li>

    

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

</ul>