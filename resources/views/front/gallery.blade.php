@extends('layouts.front')

@section('content')


<div class="gallery">
    <div>
        <h1>{{$story->title}} gallery photo </h1>
    </div>
    <div>
        @foreach($story->gallery as $photo)
        <img src="{{asset('stories-photo') .'/'. $photo->photo}}">
        @endforeach
    </div>
</div>

@endsection
