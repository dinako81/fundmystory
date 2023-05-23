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
                        @forelse($orders as $order)
                        <li class="list-group-item">
                            <div class="front-orders">
                                <div class="front-order">
                                    <div class="front-order-number">#{{$order->id}}</div>
                                    <div class="front-order-status">{{$status[$order->status]}}</div>
                                    @if($order->status == 2)
                                    <a href="{{route('front-download', $order)}}">Download</a>
                                    @endif
                                </div>
                                <div class="front-order-products">
                                    <ul class="list-group">
                                        @foreach($order->stories as $story)
                                        <li class="list-group-item">
                                            <div class="front-order-products-list">
                                                <span>{{$story['title']}}</span>
                                                <i>{{$story['text']}} eur</i>
                                                X
                                                <i>{{$story['totalamout']}}</i>

                                            </div>
                                        </li>
                                        @endforeach
                                        <li class="list-group-item">
                                            <div class="front-order-products-list">
                                                {{-- <b>{{$order->price}} eur</b> --}}
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            No Stories
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
