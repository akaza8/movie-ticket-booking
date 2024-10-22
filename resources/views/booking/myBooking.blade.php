@extends('layouts.main')


@section('content')
    <div class="container">
        <h1 class="text-center">My Bookings</h1>
        <table class="table table-striped text-center my-5">
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Showtime</th>
                    <th>No of  Tickets</th>
                    <th>Total Cost</th>
                    <th>Date</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    @foreach($movies as $movie)
                        <td>{{$movie->title}}</td>
                        <td>{{ $movie->showtime }}</td>
                    @endforeach
                        <td>{{count(explode(',', $booking->seats))}}
                            [{{ implode(', ', json_decode($booking->seats)) }}] </td>
                        <td>₹{{ $booking->total_cost }}</td>
                        <td>{{ $booking->created_at->format('d-m-Y') }}</td>
                        <td>
                            {{-- <a href="route('booking.ticket', $booking->id)" class="btn btn-info">View Ticket</a> --}}
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection


