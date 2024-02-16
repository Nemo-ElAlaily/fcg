@extends('dashboard.layouts.main')

@section('title', 'Certificate Details')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('dashboard.certificates.index') }}">Certificates</a></li>
<li class="breadcrumb-item active">{{ $certificate -> name}}</li>
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

        <form class="col-12" action="{{ route('dashboard.certificates.update', $certificate->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active" name="is_active" {{$certificate->is_active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Certificate Name</label>
                            @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="name" placeholder="Certificate Name"
                                value="{{ $certificate -> name }}" name="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">Certificate Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Certificate Slug"
                                value="{{ $certificate -> slug }}" name="slug">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            @error('description')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" id="description" name="description">
                                {{ $certificate->description }}
                            </textarea>
                        </div>

                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 text-center">
                    <div class="row">

                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Certificate Image</h2>
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
                                    <img src="{{ $certificate -> image_path }}" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="Certificate Image">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Update Certificate</button>
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
