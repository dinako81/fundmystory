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

                <form action="{{route('stories-index')}}" method="get">
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Rūšiuoti</label>
                                    <select class="form-select" name="sort">
                                        @foreach($sortSelect as $value => $text)
                                        <option value="{{$value}}" @if($value===$sort) selected @endif>{{$text}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">Pasirinkite rūšiavimo nuostatas</div>
                                </div>
                            </div>

                            {{-- <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Filtras</label>
                                    <select class="form-select" name="filter">
                                        @foreach($filterSelect as $value => $text)
                                        <option value="{{$value}}" @if($value===$filter) selected @endif>{{$text}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-text">Pasirinkite filtravimo nuostatas</div>
                    </div> --}}

                    <div class="col-3">
                        <div class="sort-filter-buttons">
                            <button type="submit" class="btn btn-outline-dark butn2 brown">Pateikti</button>
                            <a href="{{route('stories-index')}}" class="btn btn-outline-dark butn2 text-danger">Ištrinti</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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

                        <div class="buttons mx-auto">
                            <a href="{{route('front-gallery', $story)}}" class="btn btn-outline-success">More gallery photos</a>
                            <a href="{{route('stories-edit', $story)}}" class="btn btn-outline-success">Edit Story</a>
                            <form action="{{route('stories-delete', $story)}}" method="post">
                                <button type="submit" class="btn btn-outline-danger">Delete Story</button>
                                @csrf
                                @method('delete')
                            </form>

                        </div>

                        <div class="story-amount">
                            <div>
                                <span> Goal: {{$story->totalamount}} EUR</span>
                                <span> Donated: {{$story->donatedamount}} EUR</span>
                                <span> Rest: {{$story->restamount}} EUR</span>
                            </div>
                        </div>

                        <div class="buttons">
                            <form action="{{route('stories-donateamount', $story)}}" method="post">
                                <div class="form-text">Please add donated amount here</div>
                                <input type="text" class="form-control brown" name="donatedamount" value="">
                                <button type="submit" class="btn btn-outline-dark brown">Donate</button>
                                @csrf
                                @method('put')
                            </form>
                        </div>

                        <div>
                            @include('front.stars')
                        </div>

                        <div>
                            @include('front.donors')
                        </div>

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


@endsection
