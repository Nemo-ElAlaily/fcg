@if (Session::has('error') || $errors->any())
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @if (Session::has('error'))
                    {{ Session::get('error') }}
                @endif
                @if ($errors->any())
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
