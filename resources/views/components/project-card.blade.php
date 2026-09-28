<div class="col-lg-4 col-md-6 mb-4">
    <div class="post-entry-1 h-100">
        <a href="{{ route('single.project', $project->slug) }}">
            <img src="{{ $project->image_path }}" alt="{{ $project->title }}" class="img-fluid" oncontextmenu="return false;">
        </a>
        <div class="post-entry-1-contents">
            <span class="meta d-inline-block mb-0">
                {{ date('F jS, Y', strtotime($project->created_at)) }}
            </span>
            <span class="mx-2"></span>
            <span class="meta d-inline-block mb-2">{{ $project->category->name ?? 'Uncategorized' }}</span>
            <h2 class="mb-3">
                <a href="{{ route('single.project', $project->slug) }}">{{ $project->title }}</a>
            </h2>
            <p>{!! Str::limit($project->description, 120) !!}</p>
            <p>
                <a href="{{ route('single.project', $project->slug) }}" class="more-2">
                    Project Details <span class="icon-arrow_forward"></span>
                </a>
            </p>
        </div>
    </div>
</div>
