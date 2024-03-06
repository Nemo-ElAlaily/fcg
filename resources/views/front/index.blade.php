@extends('front.layouts.main')

@section('title', 'HomePage')

@section('hero')

    @if(count($sliders) > 0)

    <div id="sliderIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($sliders as $index => $slider)
                <li data-target="#sliderIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : ''  }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
            <div class="carousel-item hero-2 overlay {{ $index == 0 ? ' active' : ''  }}" style="background-image: url('{{ $slider -> image_path }}');">
                <div class="carousel-caption d-none d-md-block col-lg-5 mx-auto">
                    <h1 class="mb-5"><span class="d-block">{{ $slider -> title }}</span></h1>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#sliderIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#sliderIndicators" role="button" data-slide="next">
            <span class="sr-only">Next</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>

    @else

    <div class="hero-2 overlay" style="background-image: url('{{ asset('front/images/img_2.jpg')}}');">'
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mx-auto">
                    <h1 class="mb-5"><span class="d-block">{{ $site_settings -> welcome_phrase }}</span></h1>
                </div>
            </div>
        </div>
    </div>

    @endif

@endsection

@section('content')
<div class="section sec-1">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-3">
                <h2 class="heading">We create architectural designs</h2>
                <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias
                    beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus
                    itaque. Veniam quidem debitis odio amet voluptas distinctio dicta placeat! Et pariatur doloremque ea
                    veniam.</p>

                <p><a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a></p>
            </div>
            <div class="col-lg-7 ms-auto">
                <img src="{{ asset('front')}}/images/we-create.png" alt="Image" class="img-fluid img-r">
            </div>
        </div>
    </div>
</div>

<div class="section sec-2">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('front')}}/images/modern-arch.jpg" alt="IMage" class="img-fluid">
            </div>
            <div class="col-lg-3 ms-auto">
                <h2 class="heading">Modern Architecture</h2>
                <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias
                    beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus
                    itaque. Veniam quidem debitis odio amet voluptas distinctio dicta placeat! Et pariatur doloremque ea
                    veniam.</p>
                <p><a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a></p>
            </div>
        </div>
    </div>
</div>

@if(count($services) > 0)
<div class="sec-3 section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h2 class="heading">Services</h2>
                <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias
                    beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus
                    itaque. Veniam quidem debitis odio amet voluptas distinctio dicta placeat! Et pariatur doloremque ea
                    veniam.</p>
            </div>

            <div class="col-lg-6 ms-auto">
                <div class="accordion accordion-flush accordion-1" id="accordionFlushExample">
                    @foreach ($services as $index => $service)

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{ $service -> id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{$service->id}}"
                                aria-expanded="@if($index==0) true @endif"
                                aria-controls="flush-collapse{{$service->id}}">
                                {{ $service -> name }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{$service->id}}"
                            class="accordion-collapse collapse @if($index==0) show @endif"
                            aria-labelledby="flush-heading{{$service->id}}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-4">
                                        <img src="{{ $service -> image_path }}" alt="Image" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <p>{!! $service -> description !!}</p>
                                        <a href="#" class="more-2">Service Projects <span
                                                class="icon-arrow_forward"></span></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(count($awarded_projects) > 0)
<div class="section sec-news">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="heading">Awarded Projects</h2>
            </div>
            <div class="col-lg-6">
                <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias
                    beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus
                    itaque.</p>
            </div>
        </div>

        <div class="row">
            @foreach ($awarded_projects as $index => $project)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="post-entry-1 h-100">
                    <a href="{{ route('single.project', $project->slug) }}">
                        <img src="{{ $project -> image_path }}" alt="Image" class="img-fluid">
                    </a>
                    <div class="post-entry-1-contents">
                        <span class="meta d-inline-block mb-0">{{ date("F jS, Y", strtotime($project -> created_at)) }}
                            <span class="mx-2"></span>
                            <h2 class="mb-3"><a href="{{ route('single.project', $project->slug) }}">{{ $project ->
                                    title}}</a></h2>

                            <p>{!! $project -> description !!}</p>
                            <p><a href="{{ route('single.project', $project->slug) }}">Project Details</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if(count($projects) > 0)
<div class="section sec-news">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="heading">Porjects</h2>
            </div>
            <div class="col-lg-6">
                <p>Delectus voluptatum distinctio quos eius excepturi sunt pariatur, aut, doloribus officia ea molestias
                    beatae laudantium, quam odio ipsum veritatis est maiores velit quasi blanditiis et natus accusamus
                    itaque.</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($projects as $index => $project)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="single-portfolio">
                    <a href="{{ route('single.project', $project -> slug )}}">
                        <img src="{{ $project -> image_path}}" alt="Image" class="img-fluid">
                        <div class="contents">
                            <h3>{{ $project -> title}}</h3>
                            <div class="cat">{{$project -> category ? $project->category->name : '' }}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

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
            @if($client -> logo && $client -> logo !== 'default.png')
            <div class="item">
                <div class="testimonial-item">
                    <div class="testimonial-item-inner">
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

@endsection
