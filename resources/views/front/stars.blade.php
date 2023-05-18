<form action="{{route('front-vote', $story)}}" method="post">
    <div class="stars">
        @for($i = 1; $i < 2; $i++) <input name="star[]" type="checkbox" id="_{{$i.'-'.$story->id}}" data-star="{{$i}}" {{$story->rate >= $i ? ' checked' : ''}}>
            <label class="star{{ ceil($story->rate) == $i && $story->rate != $i ? ' half' : ''}}" for="_{{$i.'-'.$story->id}}"></label>
            @endfor
            <div class="result">
                @if($story->rate)
                {{$story->rate}} <span>({{$story->votes}} votes)</span>
                @else($condition)
                <span>No rating yet</span>
                @endif
            </div>
            @if($story->showVoteButton)
            <button type="submit" class="btn btn-info">vote</button>
            @endif
            @csrf
            @method('put')
    </div>
</form>
