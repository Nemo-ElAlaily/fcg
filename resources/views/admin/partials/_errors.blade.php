@if (Session::has('error'))

    <div class="row mt-3">
        <button type="text" class="text-sm col-md-6 col-md-offset-3  btn wrongDelivered"
            id="type-error">{{ Session::get('error') }}
        </button>
    </div>

@endif
