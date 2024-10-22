<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookingService;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Booking;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $bookingService;
    public function __construct(BookingService $bookingService){
        $this->bookingService = $bookingService;
    }

    public function index($id):View
    {
        $data=($this)->bookingService->handleIndex($id);

        return view('booking.dashboard',compact('data'));
    }

    public function displayMovies(): View{
        $movies=$this->bookingService->getPagination(4);
        return view('welcome',compact('movies'));
    }

    public function search(Request $request):JsonResponse{
        if($request->ajax()){
            $movies=Movie::where('title','LIKE','%'.$request->search.'%')->orWhere('showtime','LIKE','%'.$request->search.'%')->get();
            if($movies) return response()->json($movies);
        }
        return response()->json([], 404);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function history(): View{
        $bookings = Booking::where('user_id', Auth::id())->get();
        // dd($bookings->toArray());
        $movie_id=$bookings->pluck('movie_id');
        $movies = Movie::whereIn('id',$movie_id)->get();
        return view('booking.myBooking',compact('bookings','movies'));
    }
    public function create():void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        return $this->bookingService->handleStore($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
