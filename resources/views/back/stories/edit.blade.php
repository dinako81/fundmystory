@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Edit Story</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('stories-update', $story)}}" method="post" enctype="multipart/form-data">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Story Title</label>
                                        <input type="text" class="form-control" name="title" value={{old('title', $story->title)}}>
                                        <div class="form-text">Please add story/idea title here</div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Story Text</label>
                                        <input type="text" class="form-control" name="text" value={{old('text', $story->text)}}>
                                        <div class="form-text">Please add story text here</div>
                                    </div>
                                </div>
                                {{-- <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Story Donated Amount</label>
                                        <input type="number" class="form-control" name="totalfund" value={{old('totalfund', $story->totalamount)}}>
                                <div class="form-text">Please add story donation amount here</div>
                            </div>
                        </div> --}}

                        <div class="col-8">
                            <label class="form-label">Main Story photo</label>
                            <input type="file" class="form-control" name="photo">
                            <button type="submit" name="delete" value="1" class="mt-2 btn btn-danger">Delete photo</button>
                        </div>
                </div>
            </div>
        </div>
        <div class="mb-3" data-gallery="0">
            <label class="form-label">Gallery photo <span class="rem">X</span></label>
            <input type="file" class="form-control">
        </div>
        <div class="gallery-inputs">

        </div>

        <button type="button" class="btn btn-secondary --add--gallery">add gallery photo</button>

        <button type="submit" class="btn btn-primary">Submit</button>
        @csrf
        @method('put')
        </form>

        <ul class="list-group mt-5">
            @foreach($story->gallery as $photo)
            <li class="list-group-item">
                <form action="{{route('stories-delete-photo', $photo)}}" method="post">
                    <div class="gallery">
                        <img src="{{asset('photo') .'/'. $photo->photo}}">
                        <button type="submit" class="m-5 btn btn-danger">Delete photo</button>
                    </div>
                    @csrf
                    @method('delete')
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</div>
</div>
</div>
@endsection
