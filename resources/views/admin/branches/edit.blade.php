@extends('admin.layouts.main')

@section('title', 'Branch Details')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.branches.index') }}">Branches</a></li>
<li class="breadcrumb-item active">{{ $branch -> name }}</li>
@stop

@section('content')

@include('admin.partials._session')
@include('admin.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('admin.branches.update', $branch -> id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active" name="is_active" {{$branch->is_active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Branch Name</label>
                            @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="name" placeholder="Branch Name"
                                value="{{ $branch -> name }}" name="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">Branch Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Branch Slug"
                                value="{{ $branch -> slug }}" name="slug">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Branch Phone Number</label>
                            @error('phone_no')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="phone_no" placeholder="Branch Phone Number"
                                value="{{ $branch -> phone_no }}" name="phone_no">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">Branch Email</label>
                            @error('email')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="email" placeholder="Branch E-Mail"
                                value="{{ $branch -> email }}" name="email">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Branch P.O Box</label>
                            @error('po_box')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="po_box" placeholder="Branch P.O. Box"
                                value="{{ $branch -> po_box }}" name="po_box">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address">Branch Address</label>
                            @error('address')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="address" placeholder="Branch Address"
                                value="{{ $branch -> address }}" name="address">
                        </div>

                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 text-center">
                    <div class="row">

                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Branch Image</h2>
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
                                    <img src="{{$branch -> image_path}}" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="branch Image">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Update Branch</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card -->

</div>
@endsection
