<form action="{{route('front-donors', $story)}}" method="post">
    <div class="donors">
        <h1>Donors List:</h1>
    </div>
    @csrf
    @method('put')
</form>
