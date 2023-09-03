<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreMessage;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Traits\ApiResponseTrait;

class MessageController extends Controller
{

   use ApiResponseTrait;


        //Show All Message
        public function index()
        {
            $messages  = MessageResource::collection(Message::query()->get());
            return $this->apiResponse($messages,'ok' ,200);
        }



    public function store(StoreMessage $request) {

      //  Store data in database
      $input = $request->input();

        $message = Message::create([


            'full_name' =>  $input['full_name'],
            'phone' => $input['phone'],
            'email' =>  $input['email'],
            'subject' => $input['subject'],
            'content' =>  $input['content'],
            'agree'  => $input['agree'],
    ]);


    $message->save();
    $message = Message::find($message->id)->first();
    return $this->apiResponse(new MessageResource($message), 'Message sent successfully', 201);

}


}
