@extends('layouts.adminLayout')
@include('admin.subview.updateModal')
@section('title')
    Movies
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- SidebarSearch Form -->
            <div class="form-inline position-relative">
                <form id="searchForm" action="{{route('movies.index')}}">
                    <div class="input-group">
                        <input class="form-control mx-2" type="date" name="from_date" value="{{ request()->get('from_date') }}" id="fromDate">
                        <input class="form-control mx-2" type="date" name="to_date" value="{{ request()->get('to_date') }}" id="toDate">
                        <input class="form-control mx-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->get('search') }}" id="searchInput">
                        <div class="input-group-append mx-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-2" id="searchButton">
                                <i class="fas fa-search fa-fw mr-1"></i>
                            </button>
                            <button type="button" class="btn btn-secondary rounded-pill ml-2 px-2 " id="resetButton" onclick="window.location.href=window.location.pathname">
                                <i class="fas fa-sync fa-fw mr-1"></i>
                            </button>
                        </div>
                    </div>
                </form>
                {{-- <div class="suggestions-list" id="suggestions" style="display: none"></div> --}}
            </div>
            <a href="{{ route('movies.create') }}" class="btn btn-primary">Add New Movie</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-xl-6">
            <div id="response"></div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered table-responsive ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Duration</th>
                    <th>Cast</th>
                    <th>TheatreId</th>
                    <th>Showtime</th>
                    <th>Price</th>
                    <th>Poster</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->genre }}</td>
                        <td>{{ $movie->rating }}</td>
                        <td>{{ $movie->duration }} mins</td>
                        <td>{{ $movie->cast }}</td>
                        <td>{{ $movie->theatre_id }}</td>
                        <td>{{ $movie->showtime }}</td>
                        <td>{{ $movie->price }}</td>
                        <td><img src="{{ asset($movie->image_url) }}"
                                style="max-width: 100px; max-height: 100px; object-fit: cover;"></td>
                        <td class="d-flex flex-column ">
                            <button class="btn btn-warning btn-sm mb-2 ed-movie" data-csrf="{{ csrf_token() }}"
                                data-id="{{ $movie->id }}" data-bs-toggle="modal"
                                data-bs-target="#editMovieModal">Edit</button>
                            <button class="btn btn-danger btn-sm del-movie" data-csrf="{{ csrf_token() }}"
                                data-id="{{ $movie->id }}">Delete</button>
                            {{-- <form action="{{ route('movies.destroy', $movie->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm "
                                    onclick="return confirm('Are you sure you want to delete {{ $movie->title }}')">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-3 mx-2">
            {{ $movies->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection


@section('status4')
    active
@endsection
@section('status3')
    ""
@endsection

