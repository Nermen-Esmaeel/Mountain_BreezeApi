<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Book ;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
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
     }


 //store a Booking
 public function store(StoreBooking $request)
 {

   $input = $request->input();

       $booking = Book::create([


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
   $booking = Book::find($booking->id)->first();
    return $this->apiResponse(new BookResource($booking), 'booking created successfully', 201);

 }

}
