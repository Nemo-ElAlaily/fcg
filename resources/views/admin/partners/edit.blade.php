@extends('admin.layouts.main')

@section('title', 'Partner Details')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
<li class="breadcrumb-item active">{{ $partner -> name}}</li>
@stop

@section('content')

@include('admin.partials._session')
@include('admin.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('admin.partners.update', $partner->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active"
                                name="is_active" {{$partner->is_active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Partner Name</label>
                            @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="name" placeholder="Partner Name"
                                value="{{ $partner -> name }}" name="name">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="slug">Partner Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Partner Slug"
                                value="{{ $partner -> slug }}" name="slug">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="category_id">Category</label>
                            @error('category_id')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <!-- 1 = Projects, 2 = Partners -->
                            <select class="form-control" id="category_id" placeholder="Category"
                                value="{{ $partner-> category}}" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{ $category -> id}}" {{ $partner -> category-> id === $category -> id ?
                                    'selected': ''}}>{{ $category -> name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 text-center">
                    <div class="row">

                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Partner Logo</h2>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="logo">Logo</label>
                            @error('logo')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input image" id="logo" accept="jpg, png, jpeg, svg"
                                        name="logo">
                                    <label class="custom-file-label" for="logo">Choose Logo</label>
                                </div>
                                <div class="container">
                                    <img src="{{ $partner -> logo_path }}" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="Partner Logo">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Update Partner</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card -->

</div>
@endsection
