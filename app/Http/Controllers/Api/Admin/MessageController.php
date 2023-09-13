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
    $message = Message::find($message->id);
    return $this->apiResponse(new MessageResource($message), 'Message sent successfully', 201);

}



    //soft delete
    public function SoftDelete($id)
    {
        $message = Message::find($id);
        if ($message) {

            $message->delete($id);
            return $this->apiResponse(null, ' Message  Moved to Trash successfully', 200);
        }

        return $this->apiResponse(null, ' Message not found', 404);
    }


    //show trash
    public function trash(){

            $messages = Message::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
            if ($messages) {
                return $this->apiResponse($messages, null , 200);
            }
            return $this->apiResponse(null, 'No Messages in Trash', 404);
    }


    //restore from trached
    public function restore($id){


            $food = Message::onlyTrashed()->where('id' , $id)->first()->restore();
            return $this->apiResponse(null, 'Message restore successfully', 201);

    }


    //delete an food
    public function forceDelete($id)
    {
        $mssages = Message::findOrFail($id);
        if ($mssages) {
            $mssages->forcedelete();
            return $this->apiResponse(null, 'the mssages deleted successfully', 200);
        }

        return $this->apiResponse(null, 'the mssages not found', 404);
    }

}
