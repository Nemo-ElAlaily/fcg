@extends('front.layouts.main')

@section('title', 'Services')

@section('hero')

    <div class="hero-2 overlay" style="background-image: url('front/images/img_3.jpg');">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 mx-auto ">
					<h1 class="mb-5 text-center"><span>Our Services</span></h1>


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

    <div class="section sec-4">
        <div class="container">
            <div class="row g-5 mb-5">
                @foreach($services as $index => $service)
                    <div class="col-lg-4">
                        <div class="d-flex custom-card">
                            <div class="img">
                                <img src="{{ $service -> image_path }}" alt="{{ $service -> name }}" class="img-fluid">
                            </div>
                            <div class="text">
                                <h3 class="h6 fw-bold text-black">{{ $service -> name }}</h3>
                                <p class="text-black-50">{!! $service -> description !!}</p>
                                <p>
                                    <a href="#" class="more-2">Service Projects <span class="icon-arrow_forward"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if(count($clients) > 0)
    <div class="sec-4 section bg-light">

		<div class="text-center mb-5">
			<h2 class="heading mb-5 text-center">Our Clients</h2>
		</div>
		<div class="testimonial-slide-center-wrap" data-aos="fade-up" data-aos-delay="1">

			<div id="testimonial-nav">
				<span class="prev" data-controls="prev"><span class="icon-chevron-left"></span></span>

				<span class="next" data-controls="next"><span class="icon-chevron-right"></span></span>
			</div>

			<div class="testimonial-slide-center testimonial-center" id="testimonial-center">

                @foreach($clients as $index => $client)
                    @if($client -> logo)
                    <div class="item" >
                        <div class="testimonial-item">
                            <div  class="testimonial-item-inner">
                                <div class="testimonial-author">
                                    <img src="{{ $client -> logo_path}}" alt="Image" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

			</div>

		</div>
	</div>
    @endif

    @if(count($latest_projects) > 0)
    <div class="section sec-news">
		<div class="container">
			<div class="row mb-5">
				<div class="col-lg-6">
					<h2 class="heading">Latest Projects</h2>
				</div>
				<div class="col-lg-6">
					<p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus itaque.</p>
				</div>
			</div>

			<div class="row">
                @foreach ($latest_projects as $index => $project)
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="post-entry-1 h-100">
						<a href="#single#">
							<img src="{{ $project -> image_path }}" alt="Image"
							class="img-fluid">
						</a>
						<div class="post-entry-1-contents">
							<span class="meta d-inline-block mb-0">{{ date("F jS, Y", strtotime($project -> created_at)) }} <span class="mx-2"></span>
							<h2 class="mb-3"><a href="#single#">{{ $project -> title}}</a></h2>

							<p>{!! $project -> description !!}</p>
							<p><a href="#single#">Project Details</a></p>
						</div>
					</div>
				</div>
                @endforeach
			</div>
		</div>
	</div>
    @endif

@endsection

