<!-- /*
* Template Name: Archiark
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="{{ asset('uploads/site/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $site_settings->favicon_path }}" type="image/x-icon">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />

    @include('front.includes.css')
    @yield('style')

    <title>{{ $site_settings->title }} - @yield('title')</title>
</head>
<body>

    @include('front.includes.header')

    @yield('hero')

	@yield('content')

	@include('front.includes.footer')

	<!-- Preloader -->
	<div id="overlayer"></div>
	<div class="loader">
		<div class="spinner-border" role="status">
			<span class="visually-hidden">Loading...</span>
		</div>
	</div>

	<script src="{{ asset('front/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('front/js/tiny-slider.js')}}"></script>
	<script src="{{ asset('front/js/aos.js')}}"></script>
	<script src="{{ asset('front/js/glightbox.min.js')}}"></script>
	<script src="{{ asset('front/js/navbar.js')}}"></script>
	<script src="{{ asset('front/js/counter.js')}}"></script>
	<script src="{{ asset('front/js/custom.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</body>
</html>
