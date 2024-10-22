<?php
namespace app\Services;
use App\Models\Movie;
use App\Services;
use Illuminate\Contracts\Pagination\Paginator;

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


    
}
?>
