<form action="{{route('front-donors', $story)}}" method="post">

    <div class="donors">
        <div>
            <h1>Donors List:</h1>
        </div>

    </div>

    @csrf
    @method('put')

</form>
