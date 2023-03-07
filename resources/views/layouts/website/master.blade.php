<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/28c7efa7df.js" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="p5YH7tVqJ22_JM3Dg4FVrJy6sdWh95jEZ5SHlXTh1KI" />
    <title>@yield('title')</title>
    <!-- SEO -->
    <meta name="description" content="turkey suppliers for trading">
    <meta name=”robots” content="index, follow">
    <meta name="googlebot" content="translate">
    <link rel="alternate" hreflang="en" href="https://turkeysuppliers.online/en" />
    <link rel="alternate" hreflang="ar" href="https://turkeysuppliers.online/ar" />
    <link rel="alternate" hreflang="tr-tr" href="https://turkeysuppliers.online/tr" />
    <link rel="alternate" hreflang="fr-fr" href="https://turkeysuppliers.online/fr" />
    <link rel="alternate" hreflang="x-default" href="https://turkeysuppliers.online/" />


    <title>@yield('title')</title>


    @include('layouts.website.head')
    @yield('css')
    <style>
        a {
            text-decoration: none;
            cursor: pointer;
        }

        .open-button {
            background-color: var(--secondry-color);
            color: white;
            padding: 18px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 10%;
            right: 28px;
            font-size: 25px;
            border-radius: 50%;
        }

        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        .form-container textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            resize: none;
            min-height: 200px;
        }

        .form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;

        }

        .swiper-slide img {
            display: block;
            width: 90%;
            object-fit: cover;
        }

        @font-face {
            font-family: "CustomFont";

            src: url({{ asset('website/fonts/BebasNeue-Regular.ttf') }});
        }



        form input {
            font-family: 'arial' !important;
            font-weight: 600 !important;
            font-size: 14px !important;
        }
    </style>

    <!-- SEO -->
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PHG8XD9');
    </script>
    <!-- End Google Tag Manager -->

    @livewireStyles
</head>

<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}"
    style="font-family: CustomFont  !important;    font-weight: 100 !important;">
    @include('layouts.website.header')
    @include('layouts.website.navbar')
    @yield('content')
    @include('layouts.website.support_chat')
    <div id="chat-overlay" class="row"></div>
    <audio id="chat-alert-sound" style="display: none">
        <source src="{{ asset('sound/noti.mp3') }}" />
    </audio>
    @include('layouts.website.footer')
    @include('layouts.website.scripts')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @yield('js')
    <!-- Initialize Swiper -->
    <script>
        let swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            rtl: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            autoplay: {
                delay: 3000,
            },

            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 5,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });

        (function () {
        "use strict";

        var carousels = function () {
            $(".owl-carousel1").owlCarousel({
            loop: true,
            center: true,
            margin: 0,
            responsiveClass: true,
            nav: false,
            rtl: true,
            responsive: {
                0: {
                items: 1,
                nav: false
                },
                680: {
                items: 1,
                nav: false,
                loop: false
                },
                1000: {
                items: 1,
                nav: true
                }
            }
            });
        };

        (function ($) {
            carousels();
        })(jQuery);
        })();

                function openForm() {
                    document.getElementById("myForm").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                }
    </script>

    <!-- end of scripts -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <!--  SEO -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PHG8XD9" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

</body>

</html>
