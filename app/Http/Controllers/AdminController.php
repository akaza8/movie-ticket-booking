<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use App\Models\Seat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $AdminService;
    public function __construct(AdminService $AdminService){
        $this->AdminService = $AdminService;
    }
    public function index()
    {
        // $movies= $this->AdminService->getMovies();
        $movies=$this->AdminService->getPagination(4);
        return view('admin.dashboard',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $imageName=time().'.'.$request->image->extension();
        $movie=Movie::create(array_merge($data,['image_url'=>'assets/images/'.$imageName]));
        $request->image->move(public_path('assets/images'), $imageName);
        $theatreId=$data['theatre_id'];
        $this->AdminService->seedSeats($movie->id,$theatreId);
        return redirect()->route('movies.index')->with('success','Movie Created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): JsonResponse
    {
        $movie= Movie::findOrFail($id);
        return response()->json(['status'=>'success','movie'=> $movie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request,$id): JsonResponse
    {
        $data=$this->AdminService->handleUpdate($request,$id);
        return response()->json(['status' => 'success', 'message' => 'Movie updated successfully!','data'=>$data]);
        // $this->AdminService->handleUpdate1($request,$id);
        // return response()->json(['status' => 'success', 'message' => 'Movie updated successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie):JsonResponse
    {
        try {
            // $movie = Movie::findOrFail($id);
            $image_path = $movie->image_url;

            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            $movie->delete();
            Seat::where('movie_id',$movie->id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Movie not found or could not be deleted.'], 404);
        }
    }
    public function suggest(Request $request):JsonResponse{
        $movies=$this->AdminService->getMovie($request);
        return $movies;
    }
    public function getMoviePage(Request $request, int $id):JsonResponse{
        $movie=Movie::find($id);
        $response=$this->AdminService->getPageNumber($movie);
        return $response;
    }
}


