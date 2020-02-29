<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{  asset('docsui/favicon.png') }}">

    {!! SEO::generate(true) !!}

    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('docsui/assets/vendor/font-awesome/css/fontawesome-all.min.css') }}">

    <!-- CSS Template -->
    <link rel="stylesheet" href="{{ asset('docsui/assets/css/theme.css') }}">

    <!-- CSS Demo -->
    <link rel="stylesheet" href="{{ asset('docsui/assets/css/demo.css') }}">

    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Header -->
    @include('partials.header')
    <!-- End Header -->

    <!-- Promo Section -->
    @yield('promo')
    <!-- End Promo Section -->

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Go to Top -->
    <a class="js-go-to duik-go-to" href="javascript:;">
        <span class="fa fa-arrow-up duik-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <!-- JS Global Compulsory -->
    <script src="{{ asset('docsui/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('docsui/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('docsui/assets/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('docsui/assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- select2 -->
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

    <script>
        $(function() {
            // Aplicar select2
            $('.select2').select2();
        });
    </script>

    <!-- JS -->
    <script src="{{ asset('docsui/assets/js/main.js') }}"></script>
</body>
</html>
