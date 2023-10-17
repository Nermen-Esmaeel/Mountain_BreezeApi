<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

use App\Http\Resources\MessageResource;
use App\Http\Requests\Message\StoreMessage;

class MessageController extends Controller
{

   use ApiResponseTrait;


        //Show All Message
        public function index()
        {
            $messages  = MessageResource::collection(Message::query()->orderBy('id', 'Desc')->get());
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
            'agree'  => $request->agree,
    ]);


    $message->save();
    $message = Message::find($message->id);
    return $this->apiResponse(new MessageResource($message), 'Message sent successfully', 201);

}



    //delete an message
    public function forceDelete($id)
    {

        $mssages = Message::find($id);

        if ($mssages) {
            $mssages->delete();
            return $this->apiResponse(null, 'the mssages deleted successfully', 200);
        }

        return $this->apiResponse(null, 'the mssages not found', 404);
    }

    //delete an message
    public function deleteAll(Request $request)
    {

        $ids =  $request->ids;
        if ($ids) {
            Message::whereIn('id' ,$ids)->delete();
            return $this->apiResponse(null, 'the mssages deleted successfully', 200);
        }
    }
}
