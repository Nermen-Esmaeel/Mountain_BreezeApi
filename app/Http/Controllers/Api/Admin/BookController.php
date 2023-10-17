<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Book ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\Booking\StoreBooking;
use App\Traits\ApiResponseTrait;



class BookController extends Controller
{
    use ApiResponseTrait;



     //Show All Article
     public function index(Request $request)
     {
        $bookings = Book::query()->orderBy('id', 'Desc');
        if($request->room_type){
             $bookings->where('room_type', $request->room_type );
         }
        if($request->guests_number){
            $bookings->where('guests_number','=', $request->guests_number);
        }
        if($request->date){
          $bookings->whereDate('created_at', $request->date);

        }
         return $this->apiResponse(BookResource::collection($bookings->get()), '', 200);
     }


 //store a Booking
 public function store(StoreBooking $request)
 {


   $input = $request->input();

       $booking = Book::create([


           'full_name' =>  $input['full_name'],
           'phone' => $input['phone'],
           'email' =>  $request->email,
           'check_in_date' =>  $input['check_in_date'],
           'check_out_date' =>  $input['check_out_date'],
           'room_type' =>  $input['room_type'],
           'guests_number' =>  $input['guests_number'],
           'content' => $request->content,
   ]);


   $booking->save();
   $booking = Book::find($booking->id);
    return $this->apiResponse(new BookResource($booking), 'booking created successfully', 201);

 }

}
