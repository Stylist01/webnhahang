<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    @yield('title')

    <meta name="author" content="themesflat.com" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ $company->logo }}">
    <link rel="apple-touch-icon-precomposed" href="{{ $company->logo }}">
    @yield('addcss')
</head>

<body class="counter-scroll header-fixed">
    <!-- Preloader -->
    <div id="loading-overlay">
        <div class="loader"><img class="animation__shake" src="{{ $company->logo }}" alt="AdminLTELogo" height="60">
        </div>
    </div>
    <div id="wrapper">
        <div id="page" class="clearfix">
            @include('partials.header')
            <!-- page-title -->
            @yield('content')

            <!-- footer -->
            @include('partials.footer')
            <!-- footer -->
            <!-- scroll top button -->
            <div class="footer"> <a class="btn-top" href="javascript:void(0);" title="Top"
                    style="display: inline;"></a> </div>

            <!--====== Start Call-zalo ======-->
            <div class="global-thread-create-ctas swap-positions">
                <a href="https://zalo.me/{{ $company->phone }} " title="{{ $company->phone }} " target="_blank"
                    rel="nofollow">
                    <div class="zalo"></div>
                </a>
            </div>
            <!--====== End Call-zalo ======-->

            <div class="global-thread-create-cta swap-position">
                <div class="coccoc-alo-ph-circle-fill animate__animated  animate__pulse"
                    style="background-color: #a21d30">&nbsp;
                </div>
                <a id="hotline-cta" href="tel:{{ $company->phone }} " rel="nofollow" class="hotline-cta-swap">
                    <div class="coccoc-alo-ph-img-circle animate__animated animate__tada"
                        style="background-color: #a21d30; transform: scaleX(-1)">
                        <div class="phonee"></div>
                    </div>
                </a>
            </div>
        </div><!-- Page  -->
    </div><!-- Wrapper -->
    <!-- Javascript -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/shortcodes.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/countto.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/btn_top.js') }}"></script>
    <script>
        function redirectUser() {
            window.location.href = `{{ route('fe.login') }}`;
        }
    </script>
    @yield('addjs')
</body>

</html>
