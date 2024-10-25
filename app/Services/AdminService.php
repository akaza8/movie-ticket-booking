<?php
namespace app\Services;
use App\Models\Movie;
use App\Models\Seat;
use App\Services;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminService{
    // public function getMovies(){
    //     return Movie::all();
    // }

    public function handleStore($request): void{

        // if(array_key_exists('image',$data)){
        //     // dd($data);
        //     $imageName=$data->image;
        //     dd($imageName);
        // }

    }

    public function getPagination(int $val):Paginator{
        return Movie::paginate($val);
    }


    public function handleUpdate($request,$id): array|Movie{
        $data=$request->validated();
        $movie=Movie::findOrFail($id);
        if($request->hasFile('image')) {
            $image=$request->file('image');
            $imageName=time().'.'.$image->extension();
            $imagePath='assets/images/'.$imageName;
            $image->move(public_path('assets/images'), $imageName);
            $data['image_url']=$imagePath;
            unlink(public_path($request->currImg));
        }
        unset($data['image']);
        $movie->update($data);
        return $movie;
    }







    public function handleUpdate1($request,$id): void{
        $data = $request->validated();
        $movie = Movie::findOrFail($id);
        // if($request->hasFile('image')){
        //     $imageName=time().'.'.$request->image->extension();
        //     $data['image_url']='assets/images/'.$imageName;
        //     $request->image->move(public_path('assets/images'), $imageName);
        // }else{
        //     $data['image_url']=$movie->image_url;
        // }
        $movie->update($data);
    }


    public function seedSeats(int $id, int $theatreId): void{
        for ($number=1; $number < 33; $number++) {
            $seat = new Seat();
            $seat->movie_id=$id;
            $seat->theatre_id=$theatreId;
            $seat->number=$number;
            $seat->is_booked=0;
            $seat->save();
        }
    }

    public function getMovie(Request $request){
        $query = $request->input('query');
        $movies = Movie::where('title', 'LIKE', "%{$query}%")->orWhere('showtime','LIKE',"%{$query}%")->orWhere('cast','LIKE',"%{$query}%")->get(['title','id']);

        return response()->json($movies);
    }

    public function getPageNumber(Movie $movie){
        if(!$movie){
            return response()->json(['error'=>'movie not found'],404);
        }
        $movies=Movie::orderBy('id')->get();
        $index = $movies->search(function ($item) use ($movie) {
            return $item->id === $movie->id;
        });
        $itemsPerPage=4;
        $pageNumber=(int)(ceil(($index+1)/$itemsPerPage));
        return response()->json(['page'=>$pageNumber]);
    }
}

