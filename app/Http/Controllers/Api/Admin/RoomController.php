<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string',
            'type' => 'required|string',
            'guests_number' => 'required|integer',
            'price' => 'required|numeric',
            'content' => 'required|string',
            'images.*' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json(
                $validator->errors()->all(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $room = Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'guests_number' => $request->guests_number,
            'price' => $request->price,
            'content' => $request->content
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('Rooms', $filename);

                $room->images()->create([
                    'image_path' => $filename,
                ]);
            }
        }

        return new RoomResource($room);
    }
}
