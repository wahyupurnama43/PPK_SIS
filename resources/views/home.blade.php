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
                                            <a class="nav-link" href="#Maps">Peta</a>
                                        </li>
                                        <li class="nav-item tr-nav-item">
                                            <a class="nav-link" href="#Profile">Profile</a>
                                        </li>
                                        <li class="nav-item tr-nav-item d-mobile">
                                            <a href="{{ route('login') }}" class="btn" style="background:#fff; color: #433a8b; margin-top:20px">Masuk</a>
                                        </li>
                                    </ul>
                                    <div class="header-button d-none d-lg-inline-block">
                                        <a href="https://www.baturtengah.desa.id/" class="btn">Lihat Kita</a>
                                        <a href="{{ route('login') }}" class="btn" style="background: #433a8b;color:#fff;">Masuk</a>
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
                                    Desa Batur Tengah ini bertempat di kawasan paling timur di wilayah Batur secara keseluruhan yang mempunyai penduduk kurang lebih 950kk. Desa Batur Tengah ini juga memiliki delapan Banjar Dinas, dan mengenai jiwa di wilayah Desa Batur Tengah kurang lebih 3250 jiwa.
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
                        Pilih<br />
                        Wisata Kamu.
                    </h2>
                </div>
                <div class="row">
                    <div class="trsubHeading col-12 col-md-8 col-lg-6">
                        <p class="wow fadeIn mb-3 pb-md-0 pb-5" data-wow-duration="2s" data-wow-delay=".4s">
                            Perjalanan adalah tentang menciptakan kenangan pribadi. Dengan pilihan Anda sebagai panduan, Anda dapat merancang perjalanan yang benar-benar mencerminkan minat dan kepribadian Anda, menghasilkan kenangan yang tak terlupakan.
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
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-6.png') }}"
                                    class="img-fluid" alt="Mountain | Choose the best mountain destination" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Pura</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-7.png') }}"
                                    class="img-fluid" alt="Waterfall | image of waterfall place" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Air Panas</a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-8.png') }}"
                                    class="img-fluid"
                                    alt="Explore Skógafoss in the Winter, Skógafoss, Iceland, Iceland" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Pelukatan </a>
                                </div>
                            </div>
                        </div>
                        <div class="trCategoryItem">
                            <div class="tr-image-class">
                                <img src="{{ asset('homepage/assets/images/category-slider/category-image-5.png') }}"
                                    class="img-fluid" alt="Mountain | Choose the best mountain destination" />
                                <div class="trCategoryButton">
                                    <a href="javascript:void(0);">Gunung</a>
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
                    Nikmati<br />
                    Wisata Kami.
                </h2>
            </div>
            <div class="row">
                <div class="trsubHeading col-12 col-md-8 col-lg-6">
                    <p class="wow fadeIn mb-3 pb-md-0 pb-5" data-wow-duration="2s" data-wow-delay=".4s">
                        Nikmati momen tak terlupakan di destinasi alam yang menakjubkan. Dari pegunungan yang megah hingga pantai berpasir putih yang eksotis, perjalanan petualangan kami akan membawa Anda ke tempat-tempat yang luar biasa.
                    </p>
                </div>
            </div>
            <div class="position-relative">

                <div id="map" style="width: 100%; height: 500px; z-index:1;"></div>
            </div>
        </section>

        <!-- start Adventure Trip -->
        <section class="padding position-relative parallax parallax-image-4" id="Profile">
            <div class="container">
                <!-- HEADING TITLE -->
                <div class="trheading wow fadeInDown" data-wow-duration="2s" data-wow-delay=".4s">
                    <h2 class="mb-0">
                        Video<br />
                        Wisata  Kami.
                    </h2>
                </div>
                <div class="row">
                    <div class="trsubHeading col-12 col-md-8 col-lg-6">
                        <p class="wow fadeIn mb-3 pb-md-0 pb-5" data-wow-duration="2s" data-wow-delay=".4s">
                            Kami sangat peduli terhadap lingkungan, dan perjalanan kami dirancang dengan memperhatikan keberlanjutan. Kami akan memberikan wawasan tentang bagaimana kita dapat melestarikan alam yang indah ini.
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
        var map = L.map("map").setView([-8.2826, 115.3603], 12);

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
                    let info = e.info;
                    var marker = L.marker([e.lat, e.long])
                        .addTo(map)
                        .bindPopup(e.nama + '<br> <br>'+ info.substr(0,90) + '... <br> <br>' + "<a target='_blank' href='{{ route('api.getDetailWilayah', '') }}/"+ e.uuid+"' style='margin-top:10px; cursor:pointer;'>Lihat Detail</a>")
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
