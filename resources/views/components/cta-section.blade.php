@props(['title' => 'Ready to Start Your Project?', 'description' => 'Let us help you bring your vision to life with our expert team.', 'buttonText' => 'Contact Us', 'buttonLink' => '#'])

<div class="section sec-cta overlay" style="background-image: url('{{ asset('front/images/img_1.jpg') }}')">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-7">
                <h2 class="heading text-white mb-3 mb-lg-0">{{ $title }}</h2>
                <p class="text-white">{{ $description }}</p>
            </div>
            <div class="col-lg-auto">
                <a href="{{ $buttonLink }}" class="btn btn-primary">{{ $buttonText }}</a>
            </div>
        </div>
    </div>
</div>
