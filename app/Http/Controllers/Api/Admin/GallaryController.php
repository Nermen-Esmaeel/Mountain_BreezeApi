<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallary\StoreRequest;
use App\Http\Requests\Videos\StoreRequest as VideosStoreRequest;
use App\Http\Resources\GallaryResource;
use App\Http\Resources\VideoResource;
use App\Models\Gallary;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GallaryController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'type' => 'in:Events,Nature,Activity,Chalet,Restaurant',
        ];

        $validator = Validator::make($request->query(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $imageQuery = Gallary::query();

        if ($request->type) {
            $imageQuery = $imageQuery->where('type', 'LIKE', '%' . $request->type . '%');
        }
        return GallaryResource::collection($imageQuery->get());
    }

    public function store(StoreRequest $request)
    {
        $request->validated();

        $gallary = Gallary::create([
            'type' => $request->type,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                   $extension = $image->getClientOriginalExtension();
                    $file_to_store = 'gallery_images' . '_' . time() . '.' . $extension;
                    $image->storeAs('public/' . 'gallery_images', $file_to_store);
                    $path ='gallery_images/'.$file_to_store;

                $gallary->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return new GallaryResource($gallary);
    }
}
