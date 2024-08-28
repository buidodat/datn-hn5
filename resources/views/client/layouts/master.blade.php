<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    
    <title>
        @yield('title')
    </title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Movie Pro" />
    <meta name="keywords" content="Movie Pro" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--Template style -->
    @include('client.layouts.partials.css')

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
</body>

</html>