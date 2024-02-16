@extends('dashboard.layouts.main')

@section('title', 'Featured Images')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Featured Images</li>
@stop

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <h1>Featured Images</h1>
    </div>
    <!-- /.card -->
</div>
@endsection

@section('script')

@endsection
