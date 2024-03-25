@extends('front.layouts.main')

@section('title', 'Contact Us')

@section('hero')

<div class="hero-2 overlay" style="background-image: url('front/images/Contact-us.png');">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 mx-auto ">
					<h1 class="mb-5 text-center"><span>Contact Us</span></h1>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('content')

    <div class="section sec-contact">
		<div class="container">
			<div class="row mb-5 justify-content-center text-center">
				<div class="col-lg-5">
					<h2 class="heading">Reach Out</h2>
					<p class="text-black-50">We dedicate 100% effort to every project, regardless of size. Our team is devoted to achieving outstanding results and is deeply passionate about our work.</p>
				</div>
			</div>

            @if (Session::has('success'))
            <div class="row m-5 justify-content-center text-center">
                <button type="text" class="btn text-success" id="" disabled>
                    {{Session::get('success') }}
                </button>
            </div>
            @endif

            @if (Session::has('error'))
            <div class="row m-5 justify-content-center text-center">
                <button type="text" class="btn text-danger" id="" disabled>
                    {{ Session::get('error') }}
                </button>
            </div>
            @endif


            <form class="row" action="{{ route('post.contact') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('post') }}

				<div class="col-md-6 col-lg-6">
					<div class="mb-3">
						<label for="name" class="ps-3 mb-2">Name</label>
						<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
					</div>
				</div>

				<div class="col-md-6 col-lg-6">
					<div class="mb-3">
						<label for="email" class="ps-3 mb-2">Email</label>
						<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
					</div>
				</div>

				<div class="col-md-6 col-lg-6">
					<div class="mb-3">
						<label for="phone" class="ps-3 mb-2">Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
					</div>
				</div>

				<div class="col-md-6 col-lg-6">
					<div class="mb-3">
						<label for="subject" class="ps-3 mb-2">Subject</label>
						<input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
                        @error('subject')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
					</div>
				</div>

				<div class="col-md-12 col-lg-12">
					<div class="mb-3">
						<label for="message" class="ps-3 mb-2">Message</label>
						<textarea class="form-control" name="message" id="message" cols="30" rows="7" value="{{ old('message') }}"></textarea>
                        @error('message')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
					</div>
				</div>

				<div class="col-md-12">
					<input type="submit" value="Send message" class="btn btn-primary">
				</div>

			</form>
		</div>
	</div>

@endsection

