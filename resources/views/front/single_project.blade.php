@extends('front.layouts.main')

@section('title', $project -> title)

@section('hero')

<div class="hero-2 overlay" style="background-image: url('{{ $project -> image_path}}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto ">
                <h1 class="mb-5 text-center"><span>{{ $project -> title }}</span></h1>


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
<div class="section sec-3">
    <div class="container">

        <div class="row mb-5 justify-content-between">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <img src="{{ $project -> image_path }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-lg-5">
                <div class="heading">Description</div>
                <p>{!! $project -> description !!}</a></p>
            </div>
        </div>

        <div class="row mb-5 justify-content-between">
            <div class="col-sm-2 border-left">
                <span class="text-black-50 d-block">Scope of Services:</span>
                <ul>
                    @foreach($project -> services as $index => $service)
                    <span class="text-black-50 d-block"> {{ $service -> name }} </span>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-2 border-left">
                <span class="text-black-50 d-block">Area:</span>  {{ $project -> area }}
            </div>
            <div class="col-sm-2 border-left">
                <span class="text-black-50 d-block">Client:</span> {{ $project -> client -> name}}
            </div>
            <div class="col-sm-2 border-left">
                <span class="text-black-50 d-block">Location:</span> {{ $project  -> location }}
            </div>
            <div class="col-sm-2 border-left">
                <span class="text-black-50 d-block">Category:</span> <a href="{{route('category.projects', $project -> category -> slug)}}">{{ $project -> category -> name}}</a>
            </div>
        </div>

        @if($project -> amenities || $project -> extra_info)
        <div class="row mb-5 justify-content-between">
            @if($project -> amenities)
            <div class="col-lg-6 mb-lg-0 mb-4">
                <h3 class="text-black">Amenities</h3>
                <p>{!! $project -> amenities !!}</p>
            </div>
            @endif

            @if($project -> extra_info)
            <div class="col-lg-6 mb-lg-0 mb-4">
                <h3 class="text-black">Information</h3>
                <p>{!! $project -> extra_info !!}</p>
            </div>
            @endif
        </div>
        @endif

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
            @foreach(json_decode( $project -> gallery, true) as $index => $item)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="py-2">
                    <img src="{{ asset('uploads/projects/gallery/') . '/'. $item}}" alt="{{$project->title . $index }}" class="img-fluid">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

