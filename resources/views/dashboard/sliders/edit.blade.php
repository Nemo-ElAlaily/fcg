@extends('dashboard.layouts.main')

@section('title', 'Slider Details')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('dashboard.sliders.index') }}">Sliders</a></li>
<li class="breadcrumb-item active">Slider Detail</li>
@stop

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('dashboard.sliders.update', $slider->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active" name="is_active" {{$slider->is_active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Slider Title</label>
                            @error('title')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="title" placeholder="Slider Titles"
                                value="{{ $slider -> title }}" name="title">
                        </div>

                        <div class="row">

                            <div class="col-md-12 my-4">
                                <h2 class="text-center setting-general-title">Slider Image</h2>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="image">Image</label>
                                @error('image')
                                <span class="text-danger mx-1">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input image" id="image" accept="jpg, png, jpeg, svg"
                                            name="image">
                                        <label class="custom-file-label" for="image">Choose Image</label>
                                    </div>
                                    <div class="container">
                                        <img src="{{ $slider -> image_path }}" width="100px"
                                            class="img-thumbnail image-preview mt-1" alt="Slider Image">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-primary w-100">Update Slider</button>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
    <!-- /.card -->

</div>

@endsection
