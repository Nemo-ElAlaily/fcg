<div class="col-lg-4">
    <div class="d-flex custom-card">
        <div class="img">
            <img src="{{ $service->image_path }}" alt="{{ $service->name }}" class="img-fluid" oncontextmenu="return false;">
        </div>
        <div class="text">
            <h3 class="h6 fw-bold text-black">{{ $service->name }}</h3>
            <p class="text-black-50">{!! Str::limit($service->description, 150) !!}</p>
            <p>
                <a href="{{ $service->projects()->count() > 0 ? route('service.projects', $service->slug) : '#' }}"
                   class="more-2">Service Projects <span class="icon-arrow_forward"></span></a>
            </p>
        </div>
    </div>
</div>
