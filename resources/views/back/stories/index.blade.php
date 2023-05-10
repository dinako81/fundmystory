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
                                    <div class="story-amount">
                                        <div>
                                            <h2>{{$story->title}}</h2> {{$story->text}}<span>{{$story->totalfund}} EUR</span>

                                        </div>
                                        {{-- @if(Auth::user()->role < 5)  --}}
                                        <div class="buttons">
                                            <a href="{{route('stories-edit', $story)}}" class="btn btn-outline-success">Edit</a>
                                            <form action="{{route('stories-delete', $story)}}" method="post">
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                        {{-- @endif --}}
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
