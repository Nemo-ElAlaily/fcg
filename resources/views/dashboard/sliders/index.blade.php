@extends('dashboard.layouts.main')

@section('title', 'Sliders')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Sliders</li>
@stop

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">
        <form action="{{ route('dashboard.sliders.index') }}" method="get">

            <div class="row m-5">


                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search Here..."
                        value="{{ request()->search }}">
                </div>

                <div class="col-md-6 my-1">
                    <button type="submit" class="btn btn-square btn-outline-primary btn-sm"><i class="fa fa-search"></i>
                        Search</button>
                    <a href="{{ route('dashboard.sliders.create') }}"
                        class="btn btn-square btn-outline-secondary btn-sm"><i class="fa fa-plus"></i> Add Slider</a>
                </div>


            </div>
        </form>


        <div class="card-body bg-white">

            <table class="text-center pt-2 card-body table table-hover table-bordered">
                @if ($sliders->count() > 0)
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sliders as $index => $slider)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $slider -> title }}</td>
                        <td>{{ $slider->getActive() }}</td>
                        <td>
                            <a href="{{ route('dashboard.sliders.show', $slider->id) }}"
                                class="btn btn-square btn-info btn-sm">
                                <i class="fa fa-eye fa-lg text-lg"></i>
                            </a>
                            <a href="{{ route('dashboard.sliders.edit', $slider->id) }}"
                                class="btn btn-square btn-sm btn-success"><i class="fa fa-pen"></i></a>
                            <form action="{{ route('dashboard.sliders.destroy', $slider->id) }}" method="post"
                                style="display: inline-block">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="button" class="btn btn-square show_confirm btn-danger btn-sm txt-dark"><i
                                        class="fa fa-trash"></i></button>
                            </form><!-- end of form -->
                        </td>
                    </tr>

                    @endforeach
                </tbody>

                @else
                <h2 class="mt-5 text-center pt-2">No Data Found</h2>
                @endif

            </table><!-- end of table -->

        </div><!-- end of box body -->

        <div class="container">
            {{ $sliders->appends(request()->query())->links() }}
        </div>


    </div>
    <!-- /.card -->

</div>
@endsection

@section('script')

@endsection
