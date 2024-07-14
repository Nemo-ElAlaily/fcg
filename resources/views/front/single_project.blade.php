@extends('front.layouts.main')

@section('title', $project->title)

@section('hero')

<div class="hero-2 overlay slider-top" style="background-image: url('{{ $project->image_path }}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto ">
                <h1 class="mb-5 text-center"><span>{{ $project->title }}</span></h1>

            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="section sec-3 pb-5">
    <div class="container">

        <div class="row mb-5 justify-content-between">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <img src="{{ $project->image_path }}" alt="Image" class="img-fluid w-100">
            </div>

            <div class="col-lg-5 ms-auto">
                <div class="accordion accordion-flush accordion-1">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button no-background d-block" type="button" >
                                <p class="float-start m-0">Area:</p>
                                <p class="float-end m-0 text-black-50">{{ $project->area }}</p>
                            </button>
                        </h2>
                        <h2 class="accordion-header">
                            <button class="accordion-button no-background d-block" type="button" >
                                <p class="float-start m-0">Client:</p>
                                <p class="float-end m-0 text-black-50">{{ $project->client->name }}</p>
                            </button>
                        </h2>
                        <h2 class="accordion-header">
                            <button class="accordion-button no-background d-block" type="button" >
                                <p class="float-start m-0">Location:</p>
                                <p class="float-end m-0 text-black-50">{{ $project->location }}</p>
                            </button>
                        </h2>
                        <h2 class="accordion-header">
                            <button class="accordion-button no-background d-block" type="button" >
                                <p class="float-start m-0">Category:</p>
                                <p class="float-end m-0 text-black-50">
                                    <a class="text-black-50" href="{{ route('category.projects', $project->category->slug) }}">{{
                                        $project->category->name }}</a>
                                </p>
                            </button>
                        </h2>

                        @if ($project->amenities)
                        <h2 class="accordion-header" id="flush-heading-amenities">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse-amenities"
                                aria-expanded="false"
                                aria-controls="flush-collapse-amenities">
                                Amenities:
                            </button>
                        </h2>
                        <div id="flush-collapse-amenities"
                            class="accordion-collapse collapse"
                            aria-labelledby="flush-heading-amenities" data-bs-parent="#amenities">
                            <div class="accordion-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        <p>{!! $project->amenities !!} </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif

                        @if ($project->extra_info)
                        <h2 class="accordion-header" id="flush-heading-info">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse-info"
                                aria-expanded="false"
                                aria-controls="flush-collapse-info">
                                Information:
                            </button>
                        </h2>
                        <div id="flush-collapse-info"
                            class="accordion-collapse collapse"
                            aria-labelledby="flush-heading-info" data-bs-parent="#amenities">
                            <div class="accordion-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        <p>{!! $project->extra_info !!} </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif

                        @if ($project->services)
                        <h2 class="accordion-header" id="flush-heading-services">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse-services"
                                aria-expanded="false"
                                aria-controls="flush-collapse-services">
                                Scope of Services:
                            </button>
                        </h2>
                        <div id="flush-collapse-services"
                            class="accordion-collapse collapse"
                            aria-labelledby="flush-heading-services" data-bs-parent="#amenities">
                            <div class="accordion-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        @foreach ($project->services->sortBy('created_at') as $index => $service)
                                        <p>{{ $service->name }} </p>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif

                        <!-- <div id="flush-collapse-id##"
                            class="accordion-collapse collapse show"
                            aria-labelledby="flush-heading-id##" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        <p>Description</p>
                                    </div>
                                </div>

                            </div>
                        </div> -->
                    </div>
                </div>
            </div>


<!--
            <div class="col-lg-8"> -->
                <!-- <div class="heading">Description</div>
                    <p>{!! $project->description !!}</a></p> -->
                <!-- <div class="row justify-content-between">
                    <div class="col-sm-4">
                        <span class="text-black-50 d-block">Scope of Services:</span>
                        <ul>
                            @foreach ($project->services->sortBy('created_at') as $index => $service)
                            <span class="text-black-50 d-block"> {{ $service->name }} </span>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-4 border-left">
                        <span class="text-black-50 d-block">Area:</span>
                        <ul>
                            <span class="text-black-50 d-block"> {{ $project->area }} </span>
                        </ul>
                        <span class="text-black-50 d-block">Client:</span>
                        <ul>
                            <span class="text-black-50 d-block"> {{ $project->client->name }} </span>
                        </ul>
                        <span class="text-black-50 d-block">Location:</span>
                        <ul>
                            <span class="text-black-50 d-block"> {{ $project->location }} </span>
                        </ul>
                        <span class="text-black-50 d-block">Category:</span>
                        <ul>
                            <a href="{{ route('category.projects', $project->category->slug) }}">{{
                                $project->category->name }}</a>
                        </ul>

                    </div>
                    @if ($project->amenities || $project->extra_info)
                    <div class="col-sm-4 border-left">
                        @if ($project->amenities)
                        <div class="row mb-lg-0 mb-4">
                            <span class="text-black-50 d-block">Amenities:</span>
                            <ul>
                                <span class="text-black-50 d-block ml-4"> {!! $project->amenities !!} </span>
                            </ul>
                        </div>
                        @endif

                        @if ($project->extra_info)
                        <div class="row mb-lg-0 mb-4">
                            <span class="text-black-50 d-block">Information:</span>
                            <ul>
                                <span class="text-black-50 d-block ml-4"> {!! $project->extra_info !!} </span>
                            </ul>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div> -->
        </div>

    </div>
</div>
<div class="section sec-news pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="heading">Project Gallery</h2>
            </div>
        </div>

        <div class="flex row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 p-1">
                @foreach (json_decode($project->gallery, true) as $index => $item)
                @if ($index % 4 == 0)
                <div class="py-1">
                    <img src="{{ asset('uploads/projects/gallery/') . '/' . $item }}"
                        alt="{{ $project->title . $index }}" class="img-fluid video-wrap glightbox" data-toggle="modal"
                        data-target="#exampleModalCenter">
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 p-1">
                @foreach (json_decode($project->gallery, true) as $index => $item)
                @if ($index % 4 == 1)
                <div class="py-1">
                    <img src="{{ asset('uploads/projects/gallery/') . '/' . $item }}"
                        alt="{{ $project->title . $index }}" class="img-fluid video-wrap glightbox" data-toggle="modal"
                        data-target="#exampleModalCenter">
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 p-1">
                @foreach (json_decode($project->gallery, true) as $index => $item)
                @if ($index % 4 == 2)
                <div class="py-1">
                    <img src="{{ asset('uploads/projects/gallery/') . '/' . $item }}"
                        alt="{{ $project->title . $index }}" class="img-fluid video-wrap glightbox" data-toggle="modal"
                        data-target="#exampleModalCenter">
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 p-1">
                @foreach (json_decode($project->gallery, true) as $index => $item)
                @if ($index % 4 == 3)
                <div class="py-1">
                    <img src="{{ asset('uploads/projects/gallery/') . '/' . $item }}"
                        alt="{{ $project->title . $index }}" class="img-fluid video-wrap glightbox" data-toggle="modal"
                        data-target="#exampleModalCenter">
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
