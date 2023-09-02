<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
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
=======
use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\UpdateRequest;
use App\Http\Resources\RoomResource;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;


class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function  index()
    {
        $rooms = Room::all();
        return RoomResource::collection($rooms);
    }

    public function store(StoreRequest $request)
    {

        $request->validated();

        $room = Room::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'type' => $request->type,
            'guests_number' => $request->guests_number,
            'price' => $request->price,
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
<<<<<<< HEAD
                $image->storeAs('Rooms', $filename);

                $room->images()->create([
                    'image_path' => $filename,
=======
                $path =  $image->storeAs('images/rooms', $filename);

                $room->images()->create([
                    'image_path' => $path,
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
                ]);
            }
        }

        return new RoomResource($room);
    }
<<<<<<< HEAD
=======

    public function show(Room $room)
    {
        $room = Room::findOrFail($room->id);
        return new RoomResource($room);
    }

    public function update(UpdateRequest $request, Room $room)
    {

        $data = $request->validated();


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                Storage::disk('public')->delete('Rooms/' . $image->image);
                $filename = time() . '_' . $image->getClientOriginalName();

                $path =  $image->storeAs('images/rooms', $filename);

                $newImage = new Image(['image_path' => $path]);
                $room->images()->save($newImage);
            }
        }

        $room->update($data);

        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        Room::findOrFail($room->id);
        if ($room) {
            $room->delete();
            return response()->json([
                'message' => 'Room deleted successfuly!',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid ID!',
            ], 404);
        }
    }
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
}
