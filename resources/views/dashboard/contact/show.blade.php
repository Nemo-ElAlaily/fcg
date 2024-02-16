@extends('dashboard.layouts.main')

@section('title', 'Contact Forms')

@section('breadcrumb-items')
<li class="breadcrumb-item">Contact Forms</li>
<li class="breadcrumb-item active">{{ $form -> name }}</li>
@stop

@section('content')

<div class="col-md-12">
    <!-- card -->
    <div class="card card-primary">

        <div class="col-12">
            <div class="card-body row">
                <div class="col-md-12">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                value="{{ $form -> name }}" name="name" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email"
                                value="{{ $form -> email }}" name="email" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="phone"
                                value="{{ $form -> phone }}" name="phone" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Subject"
                                value="{{ $form -> subject }}" name="subject" disabled>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="message">Message</label>
                            <textarea type="text" class="form-control" id="message" name="message">
                                {{ $form->message }}
                            </textarea>
                        </div>

                        <form action="{{ route('dashboard.contact.update', $form->id) }}" method="post"
                            style="display: inline-block">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <button type="submit" class="btn btn-square btn-success btn-sm m-5" name="status" value="1">
                                Close Form
                            </button>
                        </form><!-- end of form -->

                        <form action="{{ route('dashboard.contact.update', $form->id) }}" method="post"
                            style="display: inline-block">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <button type="submit" class="btn btn-square btn-primary btn-sm m-5">
                                Re-Open Form
                            </button>
                        </form><!-- end of form -->

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card -->

</div>

@endsection

@section('script')

@endsection
