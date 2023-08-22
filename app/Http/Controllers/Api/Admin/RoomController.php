<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\UpdateRequest;
use App\Http\Resources\RoomResource;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

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
                $image->storeAs('Rooms', $filename);

                $newImage = new Image(['image_path' => $filename]);
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
}
