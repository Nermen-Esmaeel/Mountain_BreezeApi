<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
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
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
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
            'content_ar' => $request->content_ar,
            'floor' => $request->floor,
            'room_services' => $request->room_services,
            'bed' => $request->bed,
            'TV' => $request->TV
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path =  $image->storeAs('images/rooms', $filename);

                $room->images()->create([
                    'image_path' => $path,
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

                $path =  $image->storeAs('images/rooms', $filename);

                $newImage = new Image(['image_path' => $path]);
                $room->images()->save($newImage);
            }
        }

        $room->update($data);

        return new RoomResource($room);
    }





    //soft delete
    public function SoftDelete($id)
    {
        $room = Room::find($id);
        if ($room) {

            $room->delete($id);
            return response()->json([
                'message' => 'Room moved to trash',
            ], 200);
        }

        return response()->json(['message' => 'Invalid ID!',], 404);
    }


    //show trash
    public function trash()
    {

        $rooms = Room::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        if ($rooms) {

            return response()->json([
                'data' => $rooms,
                'message' => 'ok',
            ], 200);
        }
        return response()->json(['message' => 'No Rooms in Trash',], 404);
    }


    //restore from trached
    public function restore($id)
    {

        $room = Room::onlyTrashed()->where('id', $id)->first()->restore();
        return response()->json([
            'message' => 'Room restore successfully',
        ], 201);
    }


    public function destroy(Room $room)
    {
        Room::findOrFail($room->id);
        if ($room) {
            $room->forcedelete();
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
