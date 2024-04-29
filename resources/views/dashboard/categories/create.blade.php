@extends('dashboard.layouts.main')

@section('title', 'Create Category')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active">Create</li>
@stop

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('dashboard.categories.store') }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('post') }}
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active"
                                name="is_active" checked>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Category Name</label>
                            @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="name" placeholder="Category Name"
                                value="{{ old('name') }}" name="name">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="slug">Category Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Category Slug"
                                value="{{ old('slug') }}" name="slug">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="type">Category Type</label>
                            @error('type')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <!-- 1 = Projects, 2 = Partners -->
                            <select class="form-control" id="type" placeholder="Category type"
                            value="{{ old('type') }}" name="type">
                                <option value="1">Projects</option>
                                <option value="2">Partners</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-md-1"></div>


                <div class="col-md-5 text-center">
                    <div class="row">

                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Category Image</h2>
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
                                    <img src="{{ asset('uploads/categories/default.png') }}" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="Category Image">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <button type="submit" class="btn btn-primary w-100">Create Category</button>
                </div>
            </div>
        </form>

    </div>
<!-- /.card -->

</div>
@endsection
