@extends('front.layouts.main')

@section('title', 'HomePage')

@section('hero')

@if(count($sliders) > 0)

<div id="sliderIndicators" class="carousel slide" data-ride="carousel" style="height: 100vh;">
    <ol class="carousel-indicators">
        @foreach ($sliders as $index => $slider)
        <li data-target="#sliderIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : ''  }}">
        </li>
        @endforeach
    </ol>
    <div class="carousel-inner slider-top">
        @foreach ($sliders as $index => $slider)
        <div class="carousel-item hero-2 overlay {{ $index == 0 ? ' active' : ''  }}"
            style="background-image: url('{{ $slider -> image_path }}');">
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

<div class="hero-2 overlay slider-top" style="background-image: url('{{ asset('front/images/img_2.jpg')}}');">'
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
            <div class="col-lg-4">
                <h2 class="heading">Who We Are </h2>
                <p style="text-align: justify;">Welcome to Distinguished Experts for Architectural Engineering Co. (DEC), where creativity and precision converge to shape the future of the built environment. For over four decades, DEC has epitomized innovation and excellence in Saudi Arabia and the Middle East. Our team of visionary architects, brilliant engineers, astute urban planners, and inspired interior designers collaborate to create masterpieces that transcend construction, weaving stories into the fabric of our cities. Each project embodies sustainability, innovation, and elegance, from concept to completion. Our design-build philosophy ensures seamless execution, blending creative vision with impeccable craftsmanship. Join DEC on an adventurous journey into uncharted territories of design and engineering, crafting the future one iconic landmark at a time.</p>
                <!-- <p><a href="#" class="more-2">Learn more <span class="icon-arrow_forward"></span></a></p> -->
            </div>
            <div class="col-lg-7 ms-auto">
                <img src="{{ asset('front')}}/images/we-create.png" alt="Image" class="img-fluid img-r" oncontextmenu="return false;">
            </div>
        </div>
    </div>
</div>

@if(count($services) > 0)
<div class="section sec-news bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h2 class="heading">Services</h2>
                <p style="text-align: justify;">DEC's journey spans over four decades, evolving from a visionary founder to a vibrant team of skilled professionals. Our strength lies in diverse expertise across disciplines such as architecture, urbanism, landscape design, and structural engineering, creating a synergy that fosters innovation and excellence. With branches in Riyadh, Jeddah, Abha (Saudi Arabia), Egypt, and Lebanon, our multidisciplinary approach blends talents to push boundaries in modern design and construction, offering holistic, human-centered solutions to address complex challenges.</p>
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
                                        <img src="{{ $service -> image_path }}" alt="Image" class="img-fluid" oncontextmenu="return false;">
                                    </div>
                                    <div class="col-md-8">
                                        <p>{!! $service -> description !!}</p>
                                        <a href="{{ $service->projects()->count() > 0 ? route('service.projects', $service->slug) : '#' }}"
                                            class="more-2">Service Projects <span class="icon-arrow_forward"></span></a>
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

@if(count($projects) > 0)
<div class="section sec-news">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="heading">Latest Projects</h2>
            </div>
            <div class="col-lg-6">
                <p>We aim to design an architecture that captures and reflects the essence of the site, evoking the
                    desired feelings, sounds, and atmosphere.</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($projects as $index => $project)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="single-portfolio h-100">
                    <a href="{{ route('single.project', $project -> slug )}}" class="h-100">
                        <img src="{{ $project -> image_path}}" alt="Image" class="img-fluid h-100" oncontextmenu="return false;">
                        <div class="contents">
                            <h3>{{ $project -> title}}</h3>
                            <div class="cat">{{$project -> category ? $project->category->name : '' }}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-md-12">
                <a href="{{ route('projects')}}" class="more-2">All Projects <span
                        class="icon-arrow_forward"></span></a>
            </div>
        </div>
    </div>
</div>
@endif

@if(count($awarded_projects) > 0)
<div class="section sec-news bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="heading">Awarded Projects</h2>
            </div>
            <div class="col-lg-6">
                <p style="text-align: justify;">DEC projects have gained recognition from top trackers, magazines, and events as a result of our
                    pursuit of excellence and commitment to delivering only the finest to our clients. At DEC, we
                    recognize a group of forward-thinking designers who are determined to tackle the critical challenges
                    of our time. We are passionate about improving people's lives and serving our clients. Together, we
                    foster a culture of design excellence that combines the power of creative expression with a clear
                    sense of purpose, at the intersection of art and science.</p>
            </div>
        </div>

        <div class="row">
            @foreach ($awarded_projects as $index => $project)
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="post-entry-1 h-50">
                    <a href="{{ route('single.project', $project->slug) }}">
                        <img src="{{ $project -> image_path }}" alt="Image" class="img-fluid w-100"
                            style="height: 420px;" oncontextmenu="return false;">
                    </a>
                    <div class="post-entry-1-contents h-100">
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

@if(count($clients) > 0)
<div class="section sec-news">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="heading">Our Clients</h2>
            </div>
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
</div>
@endif
@endsection
