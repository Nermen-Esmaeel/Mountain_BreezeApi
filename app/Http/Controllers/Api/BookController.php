<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Api\ApiResponseTrait;

class BookController extends Controller
{
    use ApiResponseTrait;

     //Show All Article
     public function index()
     {
         $books  = BookResource::collection(Book::query()
         ->Select('full_name_'. request()->header('language') .' as full_name')
         ->addSelect('phone')
         ->addSelect('email')             
         ->addSelect('check_in_date')
         ->addSelect('check_out_date')
         ->addSelect('room_type_' . request()->header('language') .' as room_type')
         ->addSelect('guests_number')
         ->addSelect('content_' . request()->header('language') .' as content')
         ->get());
         return $this->apiResponse($books,'ok' ,200);
     }
 
}
