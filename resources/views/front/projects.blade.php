@extends('front.layouts.main')

@section('title', 'Projects')

@section('hero')

<div class="hero-2 overlay" style="background-image: url('front/images/img_3.jpg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto ">
                <h1 class="mb-5 text-center"><span>Our Projects</span></h1>


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

<div class="section sec-5">
    <div class="container">
        <div class="row mb-5">

            <div class="col-lg-6 ms-auto">
                <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus itaque.</p>
            </div>
        </div>

        <div class="row g-4">
            @if(count($projects) > 0)
                @foreach ($projects as $index => $project)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="single-portfolio">
                            <a href="{{ route('single.project', $project->slug )}}">
                                <img src="{{ $project -> image_path}}" alt="Image" class="img-fluid" style="height: 291px;">
                                <div class="contents">
                                    <h3>{{ $project -> title}}</h3>
                                    <div class="cat">{{$project -> category ? $project->category->name : '' }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="section bg-light">
    <div class="container">
        <div class="row mb-5 justify-content-between">
            <div class="col-lg-4 align-self-center mb-5">
                <span class="d-block subheading mb-3">We are committed</span>
                <h2 class="heading mb-4">The road of success is always under construction</h2>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
            <div class="col-lg-7">
                <a href="https://www.youtube.com/watch?v=mwtbEGNABWU" class="video-wrap glightbox">
                    <span class="icon-play"></span>
                    <img src="{{ asset('front/images/img_4.jpg')}}" alt="Image" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row g-5 bg-white">
            <div class="col-lg-4">
                <div class="d-flex custom-card">
                    <div class="img">
                        <i class="flaticon-compass"></i>
                    </div>
                    <div class="text">
                        <h3 class="h6 fw-bold text-black">We provide best services</h3>
                        <p class="text-black-50">Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias beatae laudantium.</p>
                        <p>
                            <a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex custom-card">
                    <div class="img">
                        <i class="flaticon-plan"></i>
                    </div>
                    <div class="text">
                        <h3 class="h6 fw-bold text-black">We provide best services</h3>
                        <p class="text-black-50">Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias beatae laudantium.</p>
                        <p>
                            <a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex custom-card">
                    <div class="img">
                        <i class="flaticon-architect"></i>
                    </div>
                    <div class="text">
                        <h3 class="h6 fw-bold text-black">We provide best services</h3>
                        <p class="text-black-50">Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias beatae laudantium.</p>
                        <p>
                            <a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

