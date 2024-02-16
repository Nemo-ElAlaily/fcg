@extends('admin.layouts.main')

@section('title', 'Site Settings')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Settings</li>
@stop

@section('content')

@include('admin.partials._session')
@include('admin.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <!-- form start -->
        <form class="col-12" action="{{ route('admin.settings.site.show', $site_settings->id) }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="SiteSettingsTitle">Title</label>
                            @error('title')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="SiteSettingsTitle" placeholder="Title"
                                value="{{ $site_settings -> title}}" name="title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="SitePhone">Phone Number</label>
                            @error('phone')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="SitePhone" placeholder="Phone Number"
                                value="{{ $site_settings -> phone}}" name="phone">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="SiteWelcomePhrase">Welcome Phrase</label>
                            @error('welcome_phrase')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="SiteWelcomePhrase" placeholder="Welcome Phrase"
                                value="{{ $site_settings -> welcome_phrase}}" name="welcome_phrase">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="SiteAddress">Address</label>
                            @error('address')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" id="SiteAddress" name="address">
                                {{ $site_settings -> address}}
                            </textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="siteCity">City</label>
                            @error('city')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="siteCity" placeholder="City"
                                value="{{ $site_settings -> city}}" name="city">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="siteCountry">Country</label>
                            @error('country')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="siteCountry" placeholder="Country"
                                value="{{ $site_settings -> country}}" name="country">
                        </div>

                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3 text-center">
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <h2 class="text-center setting-general-title">Site images</h2>
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
                                    <img src="{{ $site_settings->logo_path }}" width="100px"
                                        class="img-thumbnail image-preview mt-1" alt="">
                                </div>

                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="favicon">Favicon</label>
                            @error('favicon')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="favicon" class="custom-file-input favicon" id="favicon"
                                        accept="jpg, png, jpeg, svg">
                                    <label class="custom-file-label" for="favicon">Choose Favicon</label>
                                </div>
                                <div class="container">
                                    <img src="{{ $site_settings->favicon_path }}" width="100px"
                                        class="img-thumbnail favicon-preview mt-1" alt="">
                                </div>

                            </div>
                        </div>



                    </div>

                </div>

                <div class="form-group col-md-12 text-center">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="description">Our Story</label>
                            @error('story')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" id="story" name="story">
                                {{ $site_settings->story }}
                            </textarea>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="logo">Story image</label>
                            @error('story_image')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input story" id="story_image" accept="jpg, png, jpeg, svg"
                                        name="story_image">
                                    <label class="custom-file-label" for="story_image">Choose Image for our story section</label>
                                </div>
                                <div class="container">
                                    <img src="{{ $site_settings->story_image_path }}" width="100px"
                                        class="img-thumbnail story-preview mt-1" alt="">
                                </div>

                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 text-center">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="description">Our Mission</label>
                            @error('mission')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" id="mission" name="mission">
                                {{ $site_settings->mission }}
                            </textarea>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="logo">Mission image</label>
                            @error('mission_image')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input mission" id="mission_image" accept="jpg, png, jpeg, svg"
                                        name="mission_image">
                                    <label class="custom-file-label" for="mission_image">Choose Image for our mission section</label>
                                </div>
                                <div class="container">
                                    <img src="{{ $site_settings->mission_image_path }}" width="100px"
                                        class="img-thumbnail mission-preview mt-1" alt="">
                                </div>

                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 text-center">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="description">Our vision</label>
                            @error('vision')
                            <span class=" text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control" id="vision" name="vision">
                                {{ $site_settings->vision }}
                            </textarea>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="logo">Vision image</label>
                            @error('vision_image')
                            <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input vision" id="vision_image" accept="jpg, png, jpeg, svg"
                                        name="vision_image">
                                    <label class="custom-file-label" for="vision_image">Choose Image for our vision section</label>
                                </div>
                                <div class="container">
                                    <img src="{{ $site_settings->vision_image_path }}" width="100px"
                                        class="img-thumbnail vision-preview mt-1" alt="">
                                </div>

                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class='col-md-12 card my-4'>
                    <div class="card-body row">
                        <div class="col-md-12">
                            <h2 class="text-left setting-general-title my-4">SEO</h2>
                        </div>

                        <!-- facebook data -->
                        <div class="form-group col-md-6">
                            <label class="label-page">Meta Title</label>
                            <br />
                            <input class="form-control" placeholder="Meta Title" name="meta_title"
                                value="{{ $site_settings -> meta_title}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label-page">Meta Description</label>
                            <br />
                            <input class="form-control" placeholder="Meta Description" name="meta_description"
                                value="{{ $site_settings -> meta_description}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label-page">Meta Keyword</label>
                            <br />
                            <input class="form-control" placeholder="Meta Keyword" name="meta_keyword"
                                value="{{ $site_settings -> meta_keyword}}">
                        </div>

                    </div>
                </div>

                <div class='col-md-12 card my-4'>
                    <div class="card-body row">
                        <div class="col-md-12">
                            <h2 class="text-left setting-general-title ">Google Setting</h2>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group row mr-5">
                                <label class="label-page">Google Client ID</label>
                                <br />
                                <input class="form-control" name="google_client_id" placeholder="Google Client ID"
                                    name="google_client_id" value="{{ $site_settings -> google_client_id}}" />
                            </div>

                            <div class="form-group row mr-5">
                                <label class="label-page">Google Secret Key</label>
                                <br />
                                <input class="form-control" name="google_secret_key" placeholder="Google Secret Key"
                                    name="google_secret_key" value="{{ $site_settings -> google_secret_key}}">
                            </div>

                            <div class="form-group row mr-5">
                                <label class="label-page">Google Redirect Link</label>
                                <br />
                                <input class="form-control" name="google_redirect" placeholder="Google Redirect Link"
                                    name="google_redirect" value="{{ $site_settings -> google_redirect}}">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="label-page">Google Analytics</label>
                                <textarea class="form-control" rows="8" placeholder="Google Analytics"
                                    name="google_analytics"> {{ $site_settings -> google_analytics}} </textarea>
                            </div>
                        </div>
                    </div>


                </div>


                <div class='col-md-12 card my-4'>
                    <div class="card-body row">
                        <div class="col-md-12">
                            <h2 class="text-left setting-general-title my-4">Facebook Setting</h2>
                        </div>

                        <!-- facebook data -->
                        <div class="form-group col-md-6">
                            <label class="label-page">Facebook Client ID</label>
                            <br />
                            <input class="form-control" name="facebook_client_id" placeholder="Facebook Client ID"
                                name="facebook_client_id" value="{{ $site_settings -> facebook_client_id}}" >
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label-page">Facebook Secret Key</label>
                            <br />
                            <input class="form-control" name="facebook_secret_key" placeholder="Facebook Secret Key"
                                name="facebook_secret_key" value="{{ $site_settings -> facebook_secret_key}}" >
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label-page">Facebook Redirect Link</label>
                            <br />
                            <input class="form-control" name="facebook_redirect" placeholder="Facebook Redirect Link"
                                name="facebook_redirect" value="{{ $site_settings -> facebook_redirect}}" >
                        </div>

                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary w-100">Update Settings</button>
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
        $('#story').summernote({
            height: 300,
        });
    })

    $(function () {
        // Summernote
        $('#mission').summernote({
            height: 300,
        });
    })

    $(function () {
        // Summernote
        $('#vision').summernote({
            height: 300,
        });
    })
</script>
@endsection
