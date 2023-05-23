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
                    <h2>Cart</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($stories as $story)
                        <div class="product-line">

                            <div class="product-info">
                                <a href="{{route('stories-show', $story)}}">
                                    <h2>{{$story->title}}</h2>
                                </a>
                                <div class="buy cart">
                                    <span>{{$story->title}} eur</span>
                                    <form action="{{route('cart-rem')}}" method="post">
                                        <input type="hidden" name="id" value={{$story->id}}>
                                        <button type="submit" class="btn btn-danger">remove</button>
                                        @method('put')
                                        @csrf
                                    </form>
                                    <form action="{{route('cart-update')}}" method="post">
                                        <input type="hidden" name="id" value={{$story->id}}>
                                        <button type="submit" name="update" class="btn btn-info">update</button>
                                        <input type="number" value="{{$story->count}}" min="1" name="count">
                                        @method('put')
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <li class="list-group-item">
                            Cart is empty
                        </li>
                        @endforelse
                    </ul>
                    <div class="cart-bottom">
                        <div class="total">
                            Total: {{$total}} eur
                        </div>

                        <div class="buy-now">
                            @guest
                            <h3>Please login to buy</h3>
                            @else
                            <form action="{{route('cart-buy')}}" method="post">
                                <button type="submit" class="btn btn-success">Buy Now</button>
                                @csrf
                            </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
