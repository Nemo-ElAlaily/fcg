@extends('dashboard.layouts.main')

@section('title', 'Client Details')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('dashboard.clients.index') }}">Clients</a></li>
<li class="breadcrumb-item active">{{ $client -> name}}</li>
@stop

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <form class="col-12" action="{{ route('dashboard.clients.update', $client->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="form-group col-md-12 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control" id="is_active" name="is_active" {{$client->is_active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Client Name</label>
                            @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="name" placeholder="Client Name"
                                value="{{ $client -> name }}" name="name">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="slug">Client Slug</label>
                            @error('slug')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="slug" placeholder="Client Slug"
                                value="{{ $client -> slug }}" name="slug">
                        </div>

                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 text-center">
                    <div class="row">

                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Client Logo</h2>
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
                                    <img src="{{ $client -> logo_path }}" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="Client Logo">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Update Client</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card -->

</div>
@endsection
