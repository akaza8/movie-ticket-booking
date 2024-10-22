@extends('layouts.adminLayout')

@section('title')
Create Movie
@endsection
@section('content')
    <div class="container mt-4">
        <div class="card create-form">
            <div class="card-body">
                <form action="{{ route('movies.store') }}" method="post" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre</label>
                        <input type="text" name="genre" id="genre" class="form-control" value="{{old('genre')}}">
                        @error('genre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" step="0.1" value="{{old('rating')}}">
                        @error('rating')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (mins)</label>
                        <input type="number" name="duration" id="duration" class="form-control" value="{{old('duration')}}">
                        @error('duration')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cast" class="form-label">Cast</label>
                        <input type="text" name="cast" id="cast" class="form-control" value="{{old('cast')}}">
                        @error('cast')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="showtime" class="form-label">Show Time</label>
                        <input type="datetime-local" name="showtime" id="showtime" class="form-control" value="{{old('showtime')}}">
                        @error('showtime')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (₹)</label>
                        <input type="number" name="price" step="0.01" id="price" class="form-control" min="0" value="{{old('price')}}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="theatre_id" class="form-label">Theatre No</label>
                        <input type="number" name="theatre_id" step="1" id="theatre_id" class="form-control" min="0" value="{{old('theatre_id')}}">
                        @error('theatre_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Movie Poster</label>
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
@section('title')
Admin Dashboard - Add Movies
@endsection
@section('bread')
create
@endsection
@section('status2')
active
@endsection
