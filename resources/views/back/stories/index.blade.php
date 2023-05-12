@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-header">
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
                                        <img src="{{asset('photo') .'/t_'. $story->photo}}">
                                        @else
                                        <img src="{{asset('photo') .'/no.jpg'}}">
                                        @endif
                                    </div>

                                    @if(Auth::user()->role < 5) <div class="buttons">
                                        <a href="{{route('stories-edit', $story)}}" class="btn btn-outline-success">Edit Story</a>
                                        <form action="{{route('stories-delete', $story)}}" method="post">
                                            <button type="submit" class="btn btn-outline-danger">Delete Story</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                        @endif

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
                                @if(Auth::user()->role < 5) <div class="donors">
                                    <div>
                                        <h1>Donors List:</h1>
                                    </div>

                                    @endif
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
</div>
</div>
</div>


@endsection
