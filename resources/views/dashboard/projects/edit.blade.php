@extends('dashboard.layouts.main')

@section('title', 'Project Details')


@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('dashboard.projects.index') }}">Projects</a></li>
<li class="breadcrumb-item active">{{ $project -> title }}</li>
@stop



@section('content-header')
<div class="col-sm-6">
    <h1>Create project</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('dashboard.projects.index') }}">projects</a></li>
    </ol>
</div>
@stop

@section('content')

<!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row">

            <form class="col-12 dropzone" action="{{ route('dashboard.projects.update', $project -> id) }}" method="post"
                enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="row">

                    <div class="form-group col-sm-12 col-md-6">
                        <label for="category_id">Category</label>
                        @error('category_id')
                        <br />
                        <span class="text-danger mx-5">{{ $message }}</span>
                        @enderror
                        <select name="category_id" class="form-control">
                            <option value="all" disabled selected>All Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category -> id }}" {{ $project-> category && $project->category->id === $category -> id ?  'selected' : ''}}>{{ $category -> name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <label for="client_id">Client</label>
                        @error('client_id')
                        <br />
                        <span class="text-danger mx-5">{{ $message }}</span>
                        @enderror
                        <select name="client_id" class="form-control">
                            <option value="all" disabled selected>All Clients</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client -> id }}" {{ $project->client->id === $client -> id ?  'selected' : ''}}>{{ $client -> name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div> {{-- end of category --}}
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="title"> title</label>
                            @error('title')
                            <br />
                            <span class="text-danger mx-5">{{ $message }}</span>
                            @enderror
                            <input class="form-control input-thick" type="text" name="title" value="{{ $project -> title }}">
                        </div>

                        <div class="form-group">
                            <label for="slug"> slug</label>
                            @error('slug')
                            <br />
                            <span class="text-danger mx-5">{{ $message }}</span>
                            @enderror
                            <input class="form-control input-thick" type="text" name="slug" value="{{ $project -> slug }}">
                        </div>

                        <div class="form-group">
                            <label for="area"> Area</label>
                            @error('area')
                            <br />
                            <span class="text-danger mx-5">{{ $message }}</span>
                            @enderror
                            <input class="form-control input-thick" type="text" name="area" value="{{ $project -> area }}">
                        </div>

                        <div class="form-group">
                            <label for="location"> Location</label>
                            @error('location')
                            <br />
                            <span class="text-danger mx-5">{{ $message }}</span>
                            @enderror
                            <input class="form-control input-thick" type="text" name="location"
                                value="{{ $project -> location }}">
                        </div>

                        <div class="form-group col-sm-12 col-lg-12 card card-primary card-outline">

                            <table class="table table-striped table-bordered text-center mt-3">
                                <thead>
                                    <tr style="text-transform: capitalize">
                                        <th class="text-center">Is Active</th>
                                        <th class="text-center">Is Awarded</th>
                                        <th class="text-center">Add To Homepage</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr style="text-transform: capitalize">
                                        <td>
                                            <label for="is_active">
                                                <input class="" type="checkbox" name="is_active" value="1" {{ $project->is_active ?  'checked' : ''}}>
                                            </label>
                                        </td>
                                        <td>
                                            <label for="is_featured">
                                                <input class="" type="checkbox" name="is_awarded" value="1" {{ $project->is_awarded ?  'checked' : ''}}>
                                            </label>
                                        </td>
                                        <td>
                                            <label for="add_to_home">
                                                <input class="" type="checkbox" name="add_to_home" value="1" {{ $project->add_to_home ?  'checked' : ''}}>
                                            </label>
                                        </td>
                                    </tr>

                                </tbody>

                            </table> {{-- end of table --}}

                        </div> {{-- end of form group for Project Information --}}

                        <!-- check that later -->
                        <div class="form-group col-sm-12 col-md-12">
                            <label for="services">services</label>
                            @error('services')
                            <br />
                            <span class="text-danger mx-5">{{ $message }}</span>
                            @enderror
                            <select multiple name="services[]" class="form-control">
                                <option value="all" disabled {{ $project -> services -> count() == 0 ? 'selected' : ''}}>All Services</option>
                                @foreach ($services as $service)
                                <option value="{{ $service -> id }}" {{ in_array($service->id, $project->services->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $service -> name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-12 col-lg-12">
                            <label for="image">Image</label>
                            @error('image')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <input type="file" name="image" class="form-control input-sm image">

                            <img src="{{ $project -> image_path }}" width="100px"
                                class="img-thumbnail image-preview mt-1" alt="Image Preview">
                        </div> {{-- end of form group image --}}

                    </div>

                    <div class="col-sm-12 col-lg-6">

                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            @error('description')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" style="height: 100px;" id="description"
                                name="description">
                                    {{ $project -> description}}
                                </textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="amenities">Amenities</label>
                            @error('amenities')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" style="height: 100px;" id="amenities"
                                name="amenities">
                                {{ $project -> amenities}}
                                </textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="extra_info">Extra Info</label>
                            @error('extra_info')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" style="height: 100px;" id="extra_info"
                                name="extra_info">
                                {{ $project -> extra_info}}
                                </textarea>
                        </div>

                    </div>

                    <div class="row form-group col-sm-12 card card-primary card-outline">
                        <div class="col-md-12">
                            <div class="text-center col-sm-12">
                                <h3 class="m-3">Gallery</h3>
                                <hr>
                            </div>

                            @error('gallery')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror

                            <div class="input-field">
                                <div class="gallery p-2">
                                    @error('gallery')
                                    <br />
                                    <span class="text-danger mx-1">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div> {{-- end of project Media --}}
                </div>

                <div class="row ">
                    <button type="submit" class="btn btn-primary w-100"><i class="fa fa-plus"></i>
                        Update project</button>
                </div>

            </form><!-- end of form -->

        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@stop

@section('script')
<script src="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/js/image-uploader.min.js') }}"></script>

<script>

    $(function () {
        // Summernote
        $('#description').summernote({
            height: 170,
        });
        $('#amenities').summernote({
            height: 170,
        });
        $('#extra_info').summernote({
            height: 170,
        });
    })

    let preloaded = [ {{ $project -> gallery_items }}, ];

    $('.gallery').imageUploader({
        preloaded: preloaded,
        imagesInputName: 'gallery',
        preloadedInputName: 'gallery'
    });

</script>
@stop
