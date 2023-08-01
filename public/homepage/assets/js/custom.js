/* ===================================
              Loading Timeout
       ====================================== */
$(window).on("load", function () {
    "use strict";

    setTimeout(function () {
        $(".preloader").fadeOut();
    }, 200);
});

// category slider
$(".category-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    arrow: true,
    focusOnSelect: false,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 575,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

// trip slider
$(".Trip-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    dots: false,
    arrow: true,
    focusOnSelect: false,
});

// testimonial slider
$(".slider-for").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    dots: false,
    asNavFor: ".slider-nav",
});
$(".slider-nav").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: ".slider-for",
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".slider-nav .slick-center").prev().addClass("intro-prev");
$(".slider-nav .slick-center").next().addClass("intro-next");

$(".slick-next").click(function () {
    $(".slick-slide").removeClass("intro-prev");
    $(".slick-slide").removeClass("intro-next");

    $(".slider-nav .slick-center").prev().addClass("intro-prev");
    $(".slider-nav .slick-center").next().addClass("intro-next");
});
$(".slick-prev").click(function () {
    $(".slick-slide").removeClass("intro-prev");
    $(".slick-slide").removeClass("intro-next");
    $(".slider-nav .slick-center").prev().addClass("intro-prev");
    $(".slider-nav .slick-center").next().addClass("intro-next");
});
$(".slick-slide").click(function () {
    $(".slick-slide").removeClass("intro-prev");
    $(".slick-slide").removeClass("intro-next");
    $(".slider-nav .slick-center").prev().addClass("intro-prev");
    $(".slider-nav .slick-center").next().addClass("intro-next");
});

// sticky header
window.onscroll = function () {
    myFunction();
};
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

// video & iframe play button
jQuery(".play-button").click(function (e) {
    e.preventDefault();
    jQuery(this).hide();
    jQuery(".trTripContent-image").find("iframe").show();
});

jQuery(".play-button").click(function (e) {
    e.preventDefault();
    jQuery(this).hide();
    jQuery(".trTripContent-image").find("video").show();
});

// scroll active class menu
$("body").scrollspy({
    target: "#myHeader",
});

// scroll bottom to top button
// $(document).ready(function () {
//     $(window).scroll(function () {
//         if ($(this).scrollTop() > 100) {
//             $(".scroll-top").fadeIn();
//         } else {
//             $(".scroll-top").fadeOut();
//         }
//     });

//     $(".scroll-top").click(function () {
//         $("html, body").animate(
//             {
//                 scrollTop: 0,
//             },
//             100
//         );
//         return false;
//     });
// });

//   /* To Disable Inspect Element */
// $(document).bind("contextmenu",function(e) {
//  e.preventDefault();
// });

// $(document).keydown(function(e){
//     if(e.which === 123){
//        return false;
//     }
// });
// document.onkeydown = function(e) {
// if(event.keyCode == 123) {
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'I'.charCodeAt(0)){
// return false;
// }
// };
