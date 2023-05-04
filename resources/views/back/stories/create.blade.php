@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>All Stories</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('stories-store')}}" method="post">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">


                                    <div class="mb-3">
                                        <label class="form-label">Story Tile</label>
                                        <input type="text" class="form-control" name="title" value={{old('title')}}>
                                        <div class="form-text">Please add story/idea title here</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Story Donated Amount</label>
                                        <input type="text" class="form-control" name="price" value={{old('price')}}>
                                        <div class="form-text">Please add story donation amount here</div>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="colors-selectors --colors--selectors">
                                    </div>
                                </div> --}}
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
