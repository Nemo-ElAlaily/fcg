@if (Session::has('success'))

<div class="row mt-3">
    <button type="text" class="text-sm  col-md-6 col-md-offset-3  btn successDelivered" id="type-error">{{
        Session::get('success') }}
    </button>
</div>

@endif
