<ul class="list-group mt-5">
    @foreach($story->gallery as $photo)
    <img src="{{asset('stories-photo') .'/'. $photo->photo}}">
    @endforeach
</ul>
