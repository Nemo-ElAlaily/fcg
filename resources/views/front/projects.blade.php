@extends('front.layouts.main')

@section('title', 'Projects')

@section('hero')

<div class="hero-2 overlay slider-top" style="background-image: url('{{ $projects -> first() -> image_path}}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto ">
                <h1 class="mb-5 text-center"><span>
                @if (Route::currentRouteName() == 'category.projects')
                    {{ $projects -> first() ->category->name }} Projects
                @elseif(Route::currentRouteName() == 'awarded.projects')
                    Awarded Projects
                @elseif(Route::currentRouteName() == 'projects')
                    Our Projects
                @endif
                </span></h1>
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
                <p>Architecture is the bridge that connects people and places.
                    <br /> We believe quality and enduring design can transform a place and elevate the human experience.</p>
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
        <div class="d-flex justify-content-around m-5">
            {{ $projects->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- <div class="section bg-light">
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
</div> -->
<div class="section pt-0">
    <div class="container">
        <div class="row g-5 bg-white">
            <div class="col-lg-4">
                <div class="d-flex custom-card">
                    <div class="img">
                        <i class="flaticon-compass"></i>
                    </div>
                    <div class="text">
                        <h3 class="h6 fw-bold text-black">We provide best services</h3>
                        <p class="text-black-50">Our experienced team delivers exceptional services tailored to your unique needs. We pride ourselves on attention to detail and exceeding expectations. Let us help you with your next project.</p>
                        <!-- <p>
                            <a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a>
                        </p> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex custom-card">
                    <div class="img">
                        <i class="flaticon-plan"></i>
                    </div>
                    <div class="text">
                        <h3 class="h6 fw-bold text-black">We Transform</h3>
                        <p class="text-black-50">Beginning with an investigation of various physical, historical, and institutional circumstances, we study places in dialogue with their communities – to design environments that offer:
                            <ul>
                                <li>Enduring Architecture</li>
                                <li>Campus Destinations</li>
                                <li>Flexibility for the Future</li>
                            </ul>
                        </p>
                        <!-- <p>
                            <a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a>
                        </p> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex custom-card">
                    <div class="img">
                        <i class="flaticon-architect"></i>
                    </div>
                    <div class="text">
                        <h3 class="h6 fw-bold text-black">We Believe</h3>
                        <p class="text-black-50">We believe that every project is an opportunity to address global challenges</p>
                        <!-- <p>
                            <a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

