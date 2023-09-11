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

        $imageQuery = Galary::query();

        if ($request->type) {
            $imageQuery = $imageQuery->where('type', 'LIKE', '%' . $request->type . '%');
        }
        return GalaryResource::collection($imageQuery->get());
    }

    public function store(StoreRequest $request)
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
}
