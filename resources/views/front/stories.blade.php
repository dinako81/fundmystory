@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        {{-- <div class="col-3">
            @include('front.cats')
        </div> --}}
        <div class="col-9">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>My Stories</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($stories as $story)
                        <li class="list-group-item">
                            <div class="front-stories">
                                <div class="front-story">
                                    <div class="front-story-number">#{{$story->id}}</div>
                                    <div class="front-story-status">{{$status[$story->status]}}</div>
                                    @if($story->status == 2)
                                    <a href="{{route('front-download', $story)}}">Download</a>
                                    @endif
                                </div>
                                {{-- <div class="front-order-products">
                                    <ul class="list-group">
                                        @foreach($order->products as $product)
                                        <li class="list-group-item">
                                            <div class="front-order-products-list">
                                                <span>{{$product['title']}}</span>
                                <i>{{$product['price']}} eur</i>
                                X
                                <i>{{$product['count']}}</i>
                                <b>{{$product['total']}} eur</b>
                            </div>
                        </li>
                        @endforeach
                        <li class="list-group-item">
                            <div class="front-order-products-list">
                                <b>{{$order->price}} eur</b>
                            </div>
                        </li>
                    </ul>
                </div> --}}

            </div>
            </li>
            @empty
            <li class="list-group-item">
                No stories
            </li>
            @endforelse
            </ul>
        </div>
    </div>
</div>
</div>
</div>
@endsection
