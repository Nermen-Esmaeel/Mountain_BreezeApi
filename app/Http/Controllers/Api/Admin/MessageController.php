<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Message;

class MessageController extends Controller
{
    public function sendMail(StoreMessage $request) {

      //  Store data in database
      Contact::create($request->all());
      $mailData = [
        'full_name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'content' => $request->content,
        'agree'  =>$request->agree
    ];

    Mail::to('example@gmail.com')->send(new SendMail($mailData));
    return response()->json(['success' => 'The email has been sent.']);
}


}
