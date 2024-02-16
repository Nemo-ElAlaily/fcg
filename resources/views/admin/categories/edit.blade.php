@extends('admin.layouts.main')

@section('title', 'Category Details')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active">{{ $category -> name}}</li>
@stop

@section('content')

@include('admin.partials._session')
@include('admin.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('admin.categories.update', $category->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-11">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active"
                                name="is_active" {{$category->is_active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Category Name</label>
                            @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="name" placeholder="Category Name"
                                value="{{ $category -> name }}" name="name">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="slug">Category Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Category Slug"
                                value="{{ $category -> slug }}" name="slug">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="type">Category Type</label>
                            @error('type')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <!-- 1 = Projects, 2 = Partners -->
                            <select class="form-control" id="type" placeholder="Category type"
                            value="{{ $category -> getType() }}" name="type">
                                <option value="1">Projects</option>
                                <option value="2">Partners</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-md-1"></div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Update Category</button>
                </div>
            </div>
        </form>

    </div>
<!-- /.card -->

</div>
@endsection
