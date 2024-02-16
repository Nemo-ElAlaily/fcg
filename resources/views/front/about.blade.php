@extends('front.layouts.main')

@section('title', 'About Us')

@section('hero')

    <div class="hero-2 overlay" style="background-image: url('front/images/img_3.jpg');">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 mx-auto ">
					<h1 class="mb-5 text-center"><span>About Us</span></h1>


					<div class="intro-desc text-left">
						<div class="line"></div>
						<p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus itaque.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('content')
	<div class="section sec-team sec-4 pb-5">
		<div class="container">
			<div class="row border-bottom mb-5 pb-5">
				<div class="col-lg-6 mx-auto text-center">
					<h2 class="heading">We Are The Team</h2>
                    <p>{!! $site_settings -> story !!}</p>
				</div>

			</div>

		</div>
	</div>

    <div class="section sec-4">
		<div class="container">
			<div class="row border-bottom mb-5 pb-5 justify-content-between">
				<div class="col-lg-4 align-self-center mb-5">
					<h2 class="heading mb-4">Our Vision</h2>
					<p>{!! $site_settings -> vision !!}</p>
				</div>
				<div class="col-lg-7">
					<a href="https://www.youtube.com/watch?v=mwtbEGNABWU" class="glightbox">
						<!-- <span class="icon-play"></span> -->
						<img src="{{ $site_settings -> vision_image_path }}" alt="Image" class="img-fluid w-100">
					</a>
                    <!-- <img src="{{ $site_settings -> vision_image_path }}" alt="Image" class="img-fluid w-100"> -->
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-7">
					<a href="https://www.youtube.com/watch?v=mwtbEGNABWU" class="glightbox">
						<!-- <span class="icon-play"></span> -->
						<img src="{{ asset('uploads/site/D.E.C.gif') }}" alt="Image" class="img-fluid w-100">
					</a>
				</div>
                <div class="col-lg-4 align-self-center mb-5">
					<h2 class="heading heading-right mb-4">Our Mission</h2>
					<p>{!! $site_settings -> mission !!}</p>
				</div>
			</div>
		</div>
	</div>

@endsection

