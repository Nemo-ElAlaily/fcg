@extends('front.layouts.main')

@section('title', 'Services')

@section('hero')

    <div class="hero-2 overlay slider-top" style="background-image: url('front/images/Services.png');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mx-auto ">
                    <h1 class="mb-5 text-center"><span>Our Services</span></h1>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="section sec-4">
        <div class="container">
            <div class="row g-5 mb-5">
                @foreach ($services as $index => $service)
                    <div class="col-lg-4">
                        <div class="d-flex custom-card">
                            <div class="img">
                                <img src="{{ $service->image_path }}" alt="{{ $service->name }}" class="img-fluid" oncontextmenu="return false;">
                            </div>
                            <div class="text">
                                <h3 class="h6 fw-bold text-black">{{ $service->name }}</h3>
                                <p class="text-black-50">{!! $service->description !!}</p>
                                <p>
                                    <a href="{{ $service->projects()->count() > 0 ? route('service.projects', $service->slug) : '#' }}" class="more-2">Service Projects <span
                                            class="icon-arrow_forward"></span></a>
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

            <div class="owl-carousel">
                @foreach($clients as $index => $client)
                @if($client -> logo && $client -> logo !== 'default.png')

                <div class="clients-bar">
                    <img src="{{ $client -> logo_path}}" alt="Image" class="img-fluid"
                        style="height: 100px; width: unset; margin: auto;" oncontextmenu="return false;">
                </div>

                @endif
                @endforeach
            </div>
        </div>
    @endif

    @if (count($latest_projects) > 0)
        <div class="section sec-news">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-6">
                        <h2 class="heading">Our Projects</h2>
                    </div>
                    <div class="col-lg-6">
                        <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea
                            molestias beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et
                            natus accusamus itaque.</p>
                    </div>
                </div>

                <div class="row">
                    @foreach ($latest_projects as $index => $project)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="post-entry-1 h-100">
                                <a href="{{ route('single.project', $project->slug) }}">
                                    <img src="{{ $project->image_path }}" alt="Image" class="img-fluid" oncontextmenu="return false;">
                                </a>
                                <div class="post-entry-1-contents">
                                    <span
                                        class="meta d-inline-block mb-0">{{ date('F jS, Y', strtotime($project->created_at)) }}
                                        <span class="mx-2"></span>
                                        <h2 class="mb-3"><a href="{{ route('single.project', $project->slug) }}">{{ $project->title }}</a></h2>

                                        <p>{!! $project->description !!}</p>
                                        <p><a href="{{ route('single.project', $project->slug) }}">Project Details</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12">
                        <a href="{{ route('projects') }}" class="more-2">All Projects <span
                                class="icon-arrow_forward"></span></a>
                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection
