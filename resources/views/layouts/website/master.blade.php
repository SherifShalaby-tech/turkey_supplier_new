<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="p5YH7tVqJ22_JM3Dg4FVrJy6sdWh95jEZ5SHlXTh1KI" />
    <title>@yield('title')</title>
    <!-- SEO -->
    <meta name="description" content="İhracatınızı artırın,
                                    Ürünleriniz daha fazla müşteriye ulaşsın
                                    Gönderi hizmetleri sunuyoruz
                                    Aracılık hizmetleri
                                    Ve çeviri hizmetleri de sağlıyoruz">

    <meta property="og:image" content="{{asset('website/imgs/Group.png')}}"/>
    <meta property="og:title" content="TURKEYSUPPLIERS.ONLINE">
    <meta property="og:description" content="İhracatınızı artırın,
    Ürünleriniz daha fazla müşteriye ulaşsın
    Gönderi hizmetleri sunuyoruz
    Aracılık hizmetleri
    Ve çeviri hizmetleri de sağlıyoruz">
    <meta property="fb:app_id" content="100089106841143" />

    <meta name=”robots” content="index, follow">
    <meta name="googlebot" content="translate">
    <link rel="alternate" hreflang="en" href="https://turkeysuppliers.online/en" />
    <link rel="alternate" hreflang="ar" href="https://turkeysuppliers.online/ar" />
    <link rel="alternate" hreflang="tr-tr" href="https://turkeysuppliers.online/tr" />
    <link rel="alternate" hreflang="fr-fr" href="https://turkeysuppliers.online/fr" />
    <link rel="alternate" hreflang="x-default" href="https://turkeysuppliers.online/" />

    <script src="https://kit.fontawesome.com/28c7efa7df.js" crossorigin="anonymous"></script>

    @include('layouts.website.head')
    @yield('css')

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

<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
    <h1 style="display: none">turkeysuppliers</h1>
    <h1 style="display: none">turkey suppliers</h1>
    @include('layouts.website.header')
    @yield('content')

    @include('layouts.website.support_chat')
    <div id="chat-overlay" class="row"></div>
    <audio id="chat-alert-sound" style="display: none">
        <source src="{{ asset('sound/noti.mp3') }}" />
    </audio>
    <div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

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
