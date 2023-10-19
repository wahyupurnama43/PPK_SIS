<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('images/logo.png') }}" rel="icon" />
    <link rel="stylesheet" type="text/css" href="{{ asset('homepage/assets/css/fontawesome-all-min.css') }}" />
    <link rel="stylesheet" href="{{ asset('homepage/assets/css/bootstrap.min.css') }}" type="text/css" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('homepage/assets/css/animate.css') }}" /> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('homepage/assets/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('homepage/assets/css/slick-slider/slick-theme.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('homepage/assets/css/slick-slider/slick.css') }}" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('homepage/assets/css/custom.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('homepage/assets/css/media-query.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <title>Desa Batur Tengah - Home</title>
</head>

<body>
    <!-- Preloader -->
    <div id="wrap">
        <!-- Page Wrapper -->
        <div class="wrap-top-header-slider parallax parallax-image-1" id="details">
            <!-- Start Header -->
            <header class="header" id="myHeader">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="{{ asset('images/logo.png') }}" class="img-fluid"
                                        alt="The Adevnto Logo Image" style="width: 80px" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-8 col-lg-10">
                            <!-- Nav -->
                            <nav class="navbar navbar-expand-lg nabar-own p-0">
                                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon">
                                        <span class="menu_line_1"></span>
                                        <span class="menu_line_2"></span>
                                        <span class="menu_line_3"></span>
                                    </span>
                                </button>
                                <div class="collapse navbar-collapse tr-nabar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto align-self-center">
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="{{ route('home.index') }}#TripPlanner">Beranda</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="{{ route('home.index') }}#Destination">Destinasi</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="{{ route('home.index') }}#Maps">Peta</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="{{ route('home.index') }}#Profile">Profile</a>
                                        </li>
                                        <li class="nav-item tr-nav-item d-mobile">
                                            <a href="{{ route('login') }}" class="btn"
                                                style="background:#fff; color: #433a8b; margin-top:20px">Masuk</a>
                                        </li>
                                    </ul>
                                    <div class="header-button d-none d-lg-inline-block">
                                        <a href="https://www.baturtengah.desa.id/" class="btn">Lihat Kita</a>
                                        <a href="{{ route('login') }}" class="btn"
                                            style="background: #433a8b;color:#fff;">Masuk</a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header -->
            <!-- start slider section -->
            <section class="padding trmain-slider" id="TripPlanner">
                <section class="page-banner overlay pt-170 pb-220 bg_cover">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="page-banner-content text-center text-white">
                                    <h1 class="page-title">{{ $wilayah->nama }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>

            <section class="destination-details-section pt-100 pb-70">
                <div class="container">
                    <div class="destination-details-wrapper">
                        <div class="destination-info wow fadeInUp" style="visibility: visible;">
                            <h3 class="title">{{ $wilayah->nama }}</h3>
                            <div class="meta">
                                <span class="location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $wilayah->alamat }}
                                </span>
                            </div>
                            <p>{{ $wilayah->info }}</p>
                            <div class="row">
                                @php
                                    $gambar = json_decode($wilayah->img);
                                @endphp
                                @foreach ($gambar as $item)
                                <div class="col-lg-6 mb-3">
                                    <img src="{{ Storage::url('public/upload/wilayah/' . $item) }}" class="rounded mb-40"
                                        alt="Features Image" width="100%">
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <br>
            <br>
            <br>
        </div>
        <!-- start middle section-->

    </div>
    <!--end middle section-->
    <!--start footer-->
    <footer class="position-relative wow fadeIn parallax parallax-image-5" data-wow-duration="2s"
        data-wow-delay=".4s">
        <div class="container">
            <div class="Footer-copylink">
                <span><i class="fas fa-copyright"></i> All Rights Reserved by desa batur tengah <i
                        class="fas fa-heart" style="color: #ff0000"></i> I
                    2023</span>
            </div>
        </div>
    </footer>
    <!--end footer-->

    <script src="{{ asset('homepage/assets/js/jquery-3.4.1.slim.min.js') }}"></script>
    <script src="{{ asset('homepage/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('homepage/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('homepage/assets/js/slick-slider/slick.min.js') }}"></script>
    <script src="{{ asset('homepage/assets/js/slick-slider/slick.js') }}"></script>
    <script src="{{ asset('homepage/assets/js/custom.js') }}"></script>
    <script src="{{ asset('homepage/assets/js/ajax-jquery.min.js') }}"></script>

</body>

</html>
