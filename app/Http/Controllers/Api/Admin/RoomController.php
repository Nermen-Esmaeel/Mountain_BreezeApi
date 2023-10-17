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

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function  index(Request $request)
    {
        $rules = [
            'type' => 'string',
            'guests_number' => 'integer',
            'min_price' => 'numeric',
            'max_price' => 'numeric',
            'floor' => 'integer'
        ];

        $validator = Validator::make($request->query(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $rooms = Room::query();
        if ($request->room_type) {
            $rooms->where('type', $request->type);
        }
        if ($request->guests_number) {
            $rooms->where('guests_number', '=', $request->guests_number);
        }
        if ($request->floor) {
            $rooms->where('floor', '=', $request->floor);
        }
        if ($request->min_price) {
            $rooms->where('price', '>=', $request->min_price);
        } elseif ($request->max_price) {
            $rooms->where('price', '<=', $request->max_price);
        }

        return RoomResource::collection($rooms->get());
    }

    public function store(StoreRequest $request)
    {

        $request->validated();

        $room = Room::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'sub_title_en' => $request->sub_title_en,
            'sub_title_ar' => $request->sub_title_ar,
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

                $file_name = $image->getClientOriginalName();
                $file_to_store = 'room_image' . '_' . time() . $file_name;
                $image->storeAs('public/' . 'room_images', $file_to_store);
                $path = 'room_images/' . $file_to_store;

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

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $file_name = $image->getClientOriginalName();
                $file_to_store = 'room_image' . '_' . time() . $file_name;
                $image->storeAs('public/' . 'room_images', $file_to_store);
                $imagePaths[] = 'room_images/' . $file_to_store;
            }
            $room->images()->delete();
            foreach ($imagePaths as $path) {
                $room->images()->create(['image_path' => $path]);
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

        $rooms = Room::onlyTrashed()->with(['images'])->orderBy('deleted_at', 'desc')->get();
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


    public function destroy($id)
    {

        $room = Room::onlyTrashed()->where('id', $id)->first();
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
