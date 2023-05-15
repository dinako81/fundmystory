@inject('stories', App\Services\StoriesService::class)
<div class="card mt-5">
    <div class="card-header">
        <h2>Stories:</h2>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <div class="story-line">
                <a href="{{route('front-index')}}">All stories</a>
            </div>
            @forelse($stories->get() as $story)
            <div class="story-line">
                <a href="{{route('front-index', $story)}}">{{$story->title}}</a>
            </div>

            {{-- <a href="{{route('front-show-story', $story)}}">
            <h2>{{$story->title}}</h2>
            </a> --}}

            @empty
            <li class="list-group-item">
                <div class="story-line">No stories</div>
            </li>
            @endforelse
        </ul>
    </div>
</div>
