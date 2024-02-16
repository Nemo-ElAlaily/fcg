@extends('dashboard.layouts.main')

@section('title', 'Contact Forms')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Contact Forms</li>
@stop

@section('content')

@include('dashboard.partials._session')
@include('dashboard.partials._errors')

<!-- left column -->
<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">
        <form action="{{ route('dashboard.contact.index') }}" method="get">

            <div class="row m-5">


                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search Here..."
                        value="{{ request()->search }}">
                </div>

            </div>
        </form>


        <div class="card-body bg-white">

            <table class="text-center pt-2 card-body table table-hover table-bordered">
                @if ($forms->count() > 0)
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Contact Name</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($forms as $index => $form)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $form->name }}</td>
                        <td>{{ $form->subject }}</td>
                        <td>{{ $form->getStatus() }}</td>
                        <td>
                            <a href="{{ route('dashboard.contact.show', $form->id) }}"
                                class="btn btn-square btn-info btn-sm">
                                <i class="fa fa-eye fa-lg text-lg"></i>
                            </a>

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
            {{ $forms->appends(request()->query())->links() }}
        </div>


    </div>
    <!-- /.card -->

</div>
@endsection

@section('script')

@endsection
