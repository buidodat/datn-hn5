<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Movie Pro" />
    <meta name="keywords" content="Movie Pro" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />

    @yield('style-libs')

    <!--Template style -->
    @include('client.layouts.partials.css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    @yield('styles')

</head>

<body>
    <!-- preloader Start -->
    <div id="preloader">
        <div id="status">
            <img src="{{ asset('theme/client/images/header/horoscope.gif') }}" id="preloader_image" alt="loader">
        </div>
    </div>
    <!-- prs navigation Start -->

    @include('client.layouts.header')

    <!-- prs navigation End -->

    @yield('content')

    <!-- prs patner slider End -->
    <!-- prs Newsletter Wrapper Start -->

    @include('client.layouts.footer')

    <!-- prs footer Wrapper End -->
    <!-- st login wrapper Start -->

    <!-- st login wrapper End -->
    <!--main js file start-->
    @include('client.layouts.partials.js')
    <!--main js file end-->

    @yield('scripts')
    @yield('script-libs')
</body>

</html>
