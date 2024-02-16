@extends('dashboard.layouts.main')

@section('title', 'Create Offices')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('dashboard.offices.index') }}">Offices</a></li>
<li class="breadcrumb-item active">Create Service</li>
@stop

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('dashboard.offices.store') }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('post') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active" name="is_active" checked>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title">Office Title</label>
                            @error('title')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="title" placeholder="Office title"
                                value="{{ old('title') }}" name="title">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">Office Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Office Slug"
                                value="{{ old('slug') }}" name="slug">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            @error('description')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" id="description" name="description">

                            </textarea>
                        </div>

                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 text-center">
                    <div class="row">

                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Office Image</h2>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="image">Image</label>
                            @error('image')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" accept="jpg, png, jpeg, svg"
                                        name="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="container">
                                    <img src="" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="Office Image">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Create Office</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card -->

</div>
@endsection

@section('script')
<script src="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>

    $(function () {
        // Summernote
        $('#description').summernote();
    })
</script>
@endsection
