<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Videos\StoreRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
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
        $q = Video::query();

        if ($request->type) {
            $q = $q->where('type', 'LIKE', '%' . $request->type . '%');
        }
        return VideoResource::collection($q->get());
    }

    public function store(StoreRequest $request)
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
