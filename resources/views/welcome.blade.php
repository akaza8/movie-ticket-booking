@extends('layouts.main')

@section('content')
    <div class="movie-list-container">
        <a href="{{route('my.bookings')}}" class="btn btn-warning float-end history ">History</a>
        <h1 class="movie-list-title">Available Movies</h1>
        <div class="movie-list">
            @foreach ($movies as $movie)
                <div class="movie-card">
                    <img class="movie-card-img" src="{{ '/'.$movie['image_url'] }}" alt="{{ $movie['title'] }} poster">
                    <div class="movie-card-content">
                        <h2 class="movie-card-title text-white">{{ $movie['title'] }}</h2>
                        <p class="movie-card-genre">Genre: {{ $movie['genre'] }}</p>
                        <p class="movie-card-rating">Rating: {{ $movie['rating'] }}</p>
                        <p class="movie-card-cast">Cast: {{ $movie['cast'] }}</p>
                        <p class="movie-card-duration">Duration: {{ $movie['duration'] }} mins</p>
                        <p class="movie-card-price">Price:&#8377 {{ $movie['price'] }}</p>
                        <a href= "{{ route('user.booking.panel', $movie['id']) }}" class="movie-card-button mt-auto">Book Now</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-3 mx-2">
            {{ $movies->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@section('search-bar')
    <div class="input-group rounded ">
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
            aria-describedby="search-addon" id="search" />
    </div>
@endsection
