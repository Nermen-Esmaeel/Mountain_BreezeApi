<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Galary\StoreRequest;
use App\Http\Requests\Videos\StoreRequest as VideosStoreRequest;
use App\Http\Resources\GalaryResource;
use App\Http\Resources\VideoResource;
use App\Models\Galary;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalaryController extends Controller
{
    public function filteredImages(Request $request)
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

        $type = $request->query('type');
        $imageQuery = Galary::query();

        if ($type) {
            $imageQuery = $imageQuery->where('type', 'LIKE', '%' . $type . '%');
        }
        $filteredImages = $imageQuery->get();
        if ($type === 'Events') {
            return response()->json([
                'events' => GalaryResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Nature') {
            return response()->json([
                'nature' => GalaryResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Activity') {
            return response()->json([
                'activities' => GalaryResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Chalet') {
            return response()->json([
                'chalets' => GalaryResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Restaurant') {
            return response()->json([
                'restaurants' => GalaryResource::collection($filteredImages),
            ], 200);
        } else {
            // Return all images if no specific type is provided
            return response()->json([
                'images' => GalaryResource::collection($filteredImages),
            ], 200);
        }
    }

    public function storeImages(StoreRequest $request)
    {
        $request->validated();

        $galary = Galary::create([
            'type' => $request->type,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('images/galary', $filename);

                $galary->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return new GalaryResource($galary);
    }
    public function filteredVideos(Request $request)
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

        $type = $request->query('type');
        $imageQuery = Video::query();

        if ($type) {
            $imageQuery = $imageQuery->where('type', 'LIKE', '%' . $type . '%');
        }
        $filteredImages = $imageQuery->get();
        if ($type === 'Events') {
            return response()->json([
                'events' => VideoResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Nature') {
            return response()->json([
                'nature' => VideoResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Activity') {
            return response()->json([
                'activities' => VideoResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Chalet') {
            return response()->json([
                'chalets' => VideoResource::collection($filteredImages),
            ], 200);
        } elseif ($type === 'Restaurant') {
            return response()->json([
                'restaurants' => VideoResource::collection($filteredImages),
            ], 200);
        } else {
            // Return all images if no specific type is provided
            return response()->json([
                'images' => VideoResource::collection($filteredImages),
            ], 200);
        }
    }

    public function storeVideos(VideosStoreRequest $request)
    {
        $request->validated();

        $video = Video::create([
            'type' => $request->type,
            'name' => $request->name,
            'link' => $request->link
        ]);

        return new VideoResource($video);
    }
}
