@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Stories</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('stories-store')}}" method="post">

                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Story Title</label>
                                        <input type="text" class="form-control" name="title" value={{old('title')}}>
                                        <div class="form-text">Please add story/idea title here</div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="mb-3">
                                        <label class="form-label">Story Text</label>
                                        <textarea id="w3review" class="form-control" name="text" rows="7" cols="50" name="text" value={{old('text')}}>...</textarea>
                                        <div class="form-text">Please add story text here</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Story Donated Amount</label>
                                        <input type="number" class="form-control" name="totalamount" value={{old('totalfund')}}>
                                        <div class="form-text">Please add story donation amount here</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Main Cat photo</label>
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

                                <div class="col-12">
                                    <button type="submit" class="mt-5 btn btn-outline-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
