@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Stories:</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <div class="story-line">
                            <a href="{{route('front-index')}}">All stories</a>
                        </div>
                        @forelse($stories as $story)
                        <a href="{{route('stories-show', $story)}}">
                            <h2>{{$story->title}}</h2>
                        </a>
                        @empty
                        <li class="list-group-item">
                            <div class="story-line">No stories</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-9">
            <div class=" card mt-5">
                <div class="col-9 card-header">
                    <h1>Stories List</h1>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse($stories as $story)
                        <li class="list-group-item">

                            <div class="stories-list">

                                <div class="story">
                                    <div class="story-info">
                                        <h2>{{$story->title}}</h2>
                                        {{$story->text}}
                                    </div>

                                    <div class="photo">
                                        @if($story->photo)
                                        <img src="{{asset('stories-photo') .'/t_'. $story->photo}}">
                                        @else
                                        <img src="{{asset('stories-photo') .'/no.jpg'}}">
                                        @endif
                                    </div>

                                    <div class="mb-3" data-gallery="0">
                                        <label class="form-label">Gallery photo <span class="rem">X</span></label>
                                        <input type="file" class="form-control">
                                    </div>

                                    <a href="{{route('front-gallery', $story)}}" class="btn btn-outline-success">More gallery photos</a>


                                    {{-- @if(Auth::user()->role < 5)  --}}
                                    <div class="buttons mx-auto">
                                        <a href="{{route('stories-edit', $story)}}" class="btn btn-outline-success">Edit Story</a>
                                        <form action="{{route('stories-delete', $story)}}" method="post">
                                            <button type="submit" class="btn btn-outline-danger">Delete Story</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                        {{-- @endif --}}

                                        @include('front.stars')

                                        <div class="story-amount">
                                            <div>
                                                <span> Goal: {{$story->totalamount}} EUR</span>
                                                <span> Donated: {{$story->donatedamount}} EUR</span>
                                                <span> Rest: {{$story->restamount}} EUR</span>
                                            </div>

                                        </div>
                                        <div class="buttons">
                                            <form action="{{route('stories-donateamount', $story)}}" method="post">
                                                <input type="text" class="form-control brown" name="donatedamount" value="">
                                                <button type="submit" class="btn btn-outline-dark brown">Donate</button>
                                                @csrf
                                                @method('put')
                                            </form>
                                        </div>
                                    </div>
                                    {{-- @if(Auth::user()->role < 5)  --}}

                                    @include('front.donors')
                                    {{--
                                        @endif --}}

                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="cat-line">No storys</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
