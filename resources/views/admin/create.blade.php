@extends('layouts.adminLayout')

@section('title')
Create
@endsection
@section('content')
    <div class="container ">
        <div class="card create-form">
            <div class="card-body">
                <form action="{{ route('movies.store') }}" method="post" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre<span class="text-danger">*</span></label>
                        <input type="text" name="genre" id="genre" class="form-control" value="{{old('genre')}}">
                        @error('genre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
                        <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" step="0.1" value="{{old('rating')}}">
                        @error('rating')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (mins)<span class="text-danger">*</span></label>
                        <input type="number" name="duration" id="duration" class="form-control" value="{{old('duration')}}">
                        @error('duration')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cast" class="form-label">Cast<span class="text-danger">*</span></label>
                        <input type="text" name="cast" id="cast" class="form-control" value="{{old('cast')}}">
                        @error('cast')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="showtime" class="form-label">Show Time<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="showtime" id="showtime" class="form-control" value="{{old('showtime')}}">
                        @error('showtime')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (₹)<span class="text-danger">*</span></label>
                        <input type="number" name="price" step="0.01" id="price" class="form-control" min="0" value="{{old('price')}}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="theatre_id" class="form-label">Theatre No<span class="text-danger">*</span></label>
                        <input type="number" name="theatre_id" step="1" id="theatre_id" class="form-control" min="0" value="{{old('theatre_id')}}">
                        @error('theatre_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Movie Poster<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Create Movie</button>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('status3')
active
@endsection
@section('status4')
""
@endsection
