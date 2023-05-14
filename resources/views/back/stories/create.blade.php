@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Story</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('stories-store')}}" method="post" enctype="multipart/form-data">
                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label">Story title</label>
                                <input type="text" class="form-control" name="title" value={{old('title')}}>
                                <div class="form-text">Please add story title here</div>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label">Story Text</label>
                                <textarea id="" class="form-control" rows="7" cols="50" name="text" value={{old('text')}}>...</textarea>
                                <div class="form-text">Please add story text here</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Story donated amount</label>
                                <input type="text" class="form-control" name="totalamount" value={{old('totalamount')}}>
                                <div class="form-text">Please add story donated amount here</div>
                                </textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Story photo</label>
                            <input type="file" class="form-control" name="photo">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
