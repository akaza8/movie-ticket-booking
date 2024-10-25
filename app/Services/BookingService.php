<?php
namespace app\Services;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Showtime;
use App\Models\Booking;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
class BookingService{
    public function getPagination(int $val):Paginator{
        return Movie::paginate($val);
    }

    public function handleIndex($id): array{
        $movie = Movie::findOrFail($id);
        $seats=Seat::where('movie_id',$movie->id)->get();
        // $showtimes=Showtime::where('movie_id',$movie->id)->get();
        return [$movie,$seats];
    }

    public function handleStore($request):JsonResponse{
        $data = $request->all();
        $user_id=$request->input('user_id');
        $movie_id=$request->input('movie_id');
        $total_cost=$request->input('total_cost');
        $seats=array_map('intval',$request->input('seats'));
        $existingSeats = Seat::whereIn('id', $seats)->get();

        $seatNo=[];
        foreach ($existingSeats as $seat) {
            $seatNo[]=$seat->number;
            $seat->is_booked = 1;
            $seat->save();
        }

        $booking = new Booking();
        $booking->user_id=$user_id;
        $booking->movie_id=$movie_id;
        $booking->total_cost=$total_cost;
        $booking->seats=json_encode($seatNo);
        $booking->save();
        $bookingId=$booking->id;
        // $qrCode = QrCode::size(250)->generate($id);
        // $qrCodePath=public_path('assets/images/qrcode-'.$id.'.png');
        // $qrCode = QrCode::format('png')->size(250)->generate($id);
        // Storage::put($qrCodePath, $qrCode);
        // 'qr_code'=>asset('assets/images/qrcode-'.$id.'png') into response

        return response()->json(['message'=>'success','seats'=>$seats,'seatNo'=>$seatNo]);
    }
}


