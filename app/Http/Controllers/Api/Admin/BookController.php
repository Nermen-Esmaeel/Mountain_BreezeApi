<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\{Book , Room};
use App\Http\Controllers\Controller;
use App\Http\Resources\{BookResource , RoomResource} ;
use App\Http\Requests\Booking\StoreBooking;
use App\Traits\ApiResponseTrait;



class BookController extends Controller
{
    use ApiResponseTrait;

     //Show All Article
     public function index()
     {
         $books  = BookResource::collection(Book::query()->get());
         return $this->apiResponse($books,'ok' ,200);

        //  $date = Carbon::now()->format('d-m-Y');
       // dd($d->gt($datenow));


    //    $date_now = Carbon::now()->format('d-m-Y');


        //  $bool_date = Book::where('check_out_date' ,'>=', Carbon::now()->format('Y-m-d') )->get();
        //  dd( $bool_date );
     }


     public function getAvailableRoom(){

        $rooms_available = Room::query()
       ->where('status', '=', 'available')
       ->pluck('id')->toArray();

       if($rooms_available){
        return $this->apiResponse( $rooms_available,'rooms available' ,200);
       }
       return $this->apiResponse(null, 'There are no rooms currently available', 404);
     }




 //store a Booking
 public function store(StoreBooking $request)
 {

   $input = $request->input();

       $booking = Book::create([

           'room_id' =>   $input['room_id'],
           'full_name' =>  $input['full_name'],
           'phone' => $input['phone'],
           'email' =>  $input['email'],
           'check_in_date' =>  $input['check_in_date'],
           'check_out_date' =>  $input['check_out_date'],
           'room_type' =>  $input['room_type'],
           'guests_number' =>  $input['guests_number'],
           'content' =>  $input['content'],
   ]);


   $booking->save();

   $room = Room::find($booking->room->id);
   $room->status="unavailable";
   $room->save();

   $booking = Book::find($booking->id)->first();
    return $this->apiResponse(new BookResource($booking), 'booking created successfully', 201);

 }

}