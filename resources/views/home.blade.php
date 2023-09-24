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
        <div class="wrap-top-header-slider parallax parallax-image-1">
            <!-- shape-two -->
            <div class="position-relative">
                <div class="shape-image-two">
                    <img src="{{ asset('homepage/assets/images/background-shape/dottd-squre.png') }}" class="img-fluid"
                        alt="the background decorated dotted square image" />
                </div>
            </div>
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
                                            <a class="nav-link" href="#TripPlanner">Beranda</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="#Destination">Destinasi</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="#Maps">Maps</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="#Profile">Profile</a>
                                        </li>
                                    </ul>
                                    <div class="header-button d-none d-lg-inline-block">
                                        <a href="https://www.baturtengah.desa.id/" class="btn">Lihat Kita</a>
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
                <div class="tr-slider-image col-xl-5 col-lg-6 col-sm-6 col-7 p-0">
                    <img src="{{ asset('homepage/assets/images/silders/slider-image.png') }}"
                        class="img-fluid wow fadeIn" alt="the Girl on the beach - best destination Image"
                        data-wow-delay="1s" />
                </div>
                <div class="container trtop-baner-content">
                    <div class="row">
                        <div class="col-12 col-sm-11 col-md-9 col-lg-9 col-xl-10">
                            <div class="siider-content">
                                <h1 class="wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".4s">
                                    Welcome<br />
                                    Desa Batur Tengah
                                </h1>
                                <p class="wow fadeInDown hero" data-wow-duration="1s" data-wow-delay=".3s">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime recusandae ad ducimus distinctio. Obcaecati quasi natus illo hic? Consectetur rem placeat temporibus aut quis iusto repellendus debitis fuga, vero quas?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- start middle section-->
        <!-- start Experience Travel With Us -->
        <section class="padding position-relative margin-top parallax parallax-image-2">
            <!-- shape-two -->
            <div class="shape-image-two">
                <img src="{{ asset('homepage/assets/images/background-shape/dottd-squre.png') }}" class="img-fluid"
                    alt="the background decorated dotted square image" />
            </div>
        </section>
        <!-- start choose category -->
        <section class="position-relative parallax parallax-image-3" id="Destination">
            <div class="container">
                <!-- HEADING TITLE -->
                <div class="trheading wow fadeInDown" data-wow-duration="2s" data-wow-delay=".4s">
                    <h2 class="mb-0">
                        Choose<br />
                        Your Category.
                    </h2>
                </div>
                <div class="row">
                    <div class="trsubHeading col-12 col-md-8 col-lg-6">
                        <p class="wow fadeIn mb-3 pb-md-0 pb-5" data-wow-duration="2s" data-wow-delay=".4s">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                            nulla pariatur.
                        </p>
                    </div>
                </div>
                <div class="position-relative wow fadIn" data-wow-duration="2s" data-wow-delay=".4s">
                    <!-- shape-three -->
                    <div class="shape-image-six">
                        <img src="{{ asset('homepage/assets/images/background-shape/shape-3.png') }}"
                            class="img-fluid"
                            alt="background shape image for the page decoration effects | with animation" />
                    </div>
                    <!--End shape-three -->
                    <!-- start image content -->
                    <div class="slider category-slider">
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-1.png') }}"
                                    class="img-fluid" alt="Mountain | Choose the best mountain destination" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Mountain</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-2.png') }}"
                                    class="img-fluid" alt="Waterfall | image of waterfall place" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Waterfall</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-3.png') }}"
                                    class="img-fluid"
                                    alt="Explore Skógafoss in the Winter, Skógafoss, Iceland, Iceland" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Snow</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-1.png') }}"
                                    class="img-fluid" alt="Mountain | Choose the best mountain destination" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Mountain</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-2.png') }}"
                                    class="img-fluid" alt="Waterfall | image Of Waterfall place" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Waterfall</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-4.png') }}"
                                    class="img-fluid"
                                    alt="Explore Skógafoss in the Winter, Skógafoss, Iceland, Iceland" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Snow</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container padding position-relative margin-top parallax parallax-image-2" id="Maps">
            <!-- HEADING TITLE -->
            <div class="trheading wow fadeInDown" data-wow-duration="2s" data-wow-delay=".4s">
                <h2 class="mb-0">
                    Our<br />
                    Adventure Trip.
                </h2>
            </div>
            <div class="row">
                <div class="trsubHeading col-12 col-md-8 col-lg-6">
                    <p class="wow fadeIn mb-3 pb-md-0 pb-5" data-wow-duration="2s" data-wow-delay=".4s">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                        nulla pariatur.
                    </p>
                </div>
            </div>
            <div class="position-relative">

                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </section>

        <!-- start Adventure Trip -->
        <section class="padding position-relative parallax parallax-image-4" id="Profile">
            <div class="container">
                <!-- HEADING TITLE -->
                <div class="trheading wow fadeInDown" data-wow-duration="2s" data-wow-delay=".4s">
                    <h2 class="mb-0">
                        Our<br />
                        Adventure Trip.
                    </h2>
                </div>
                <div class="row">
                    <div class="trsubHeading col-12 col-md-8 col-lg-6">
                        <p class="wow fadeIn mb-3 pb-md-0 pb-5" data-wow-duration="2s" data-wow-delay=".4s">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                            nulla pariatur.
                        </p>
                    </div>
                </div>

                <div class="position-relative wow fadeIn" data-wow-duration="2s" data-wow-delay=".4s">
                    <!-- start image content -->
                    <div class="slider Trip-slider">
                        <div class="trTripItem">
                            <div class="trTripContent-image"
                                style=" background: url({{ asset('homepage/assets/images/trip-images/trip-1.png') }});no-repeat; background-size: cover;">
                                <!-- video tag  -->
                                <video controls width="500" height="500" autoplay>
                                    <source src="{{ asset('homepage/assets/videos/productionID_4124898.mp4') }}"
                                        type="video/mp4" />
                                </video>

                                <!-- iframe video -->
                                <!-- <iframe class="vid" id="yt" width="727" height="600" src="https://www.youtube.com/embed/7oDb-6kHXZo?autoplay=1" allowfullscreen allow="autoplay"></iframe> -->

                                <!-- play button -->
                                <a class="play-button" href="#">
                                    <i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shape-eight -->
                <div class="shape-image-eight">
                    <img src="{{ asset('homepage/assets/images/background-shape/shape-8.png') }}" class="img-fluid"
                        alt="Dotted shape | background shape image for the page decoration" />
                </div>
                <!--End shape-eight -->
            </div>
        </section>
    </div>
    <!--end middle section-->
    <!--start footer-->
    <footer class="position-relative wow fadeIn parallax parallax-image-5" data-wow-duration="2s"
        data-wow-delay=".4s">
        {{-- <div class="footer-bottom">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="trFooter-logo">
                            <a href="index.html">
                                <img src="{{ asset('homepage/assets/images/logo/logo.png') }}" class="img-fluid"
                                    alt="the logo image | Footer Adventure Logo" />
                            </a>
                            <p class="trFooter-desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <div class="trFooter-conatct">
                                <a href="javascript:void(0);">+0123 456 789</a> <br /><a
                                    href="javascript:void(0);">info@travexo.com</a>
                                <br /><a href="javascript:void(0);">www.travexo.com</a>
                            </div>
                            <div class="Footer-socialicon">
                                <ul class="m-0 p-0">
                                    <li>
                                        <a href="javascript:void(0);" class="trSocial-icon"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="trSocial-icon"><i
                                                class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="trSocial-icon"><i
                                                class="fab fa-pinterest-p"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="trSocial-icon"><i
                                                class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="trSocial-icon"><i
                                                class="fab fa-google-plus-g"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1"></div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <div class="trFooter-menu">
                            <h3 class="footerTitle">Activities</h3>
                            <ul class="p-0 m-0">
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Mountain Biking</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Hiking</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Destination</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Stories</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <div class="trFooter-menu">
                            <h3 class="footerTitle">Booking</h3>
                            <ul class="p-0 m-0">
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Ticket</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Travel Product</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Packages</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Accommodation</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <div class="trFooter-menu">
                            <h3 class="footerTitle">Contact</h3>
                            <ul class="p-0 m-0">
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Team</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Jobs</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Tourist Office</a>
                                </li>
                                <li class="trFooter-link">
                                    <a href="javascript:void(0);">Brochures</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="container">
            <div class="Footer-copylink">
                <span><i class="fas fa-copyright"></i> All Rights Reserved by desa batur tengah <i class="fas fa-heart" style="color: #ff0000"></i> I
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

    <script>
        var map = L.map("map").setView([-8.2826, 115.3603], 16);

        var tiles = L.tileLayer(
            "https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }
        ).addTo(map);

        $.ajax({
            url: "{{ route('api.wilayah') }}",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {

                res.forEach(e => {
                    var marker = L.marker([e.lat, e.long])
                        .addTo(map)
                        .bindPopup(e.info + '<br>' + e.alamat)
                        .openPopup();
                });

            }
        });
    </script>
    <script>
        new WOW().init();
    </script>
</body>

</html>
