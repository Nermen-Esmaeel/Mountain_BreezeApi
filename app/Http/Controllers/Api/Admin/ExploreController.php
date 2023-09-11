<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Explore\StoreRequest;
use App\Http\Requests\Explore\UpdateRequest;
use App\Http\Resources\ExploreResource;
use App\Models\Explore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Exporter\Exporter;

class ExploreController extends Controller
{

    public function index(Request $request)
    {
        $rules = [
            'tags' => 'in:Events,Nature,Activity,Chalet,Restaurant,Pool',
        ];

        $validator = Validator::make($request->query(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $exploreQuery = Explore::query();

        if ($request->tags) {
            $exploreQuery = $exploreQuery->where('tags', 'LIKE', '%' . $request->tags . '%');
        }
        return ExploreResource::collection($exploreQuery->get());
    }


    public function store(StoreRequest $request)
    {
        $request->validated();

        if ($request->hasFile('article_cover') && $request->file('article_cover')->isValid()) {
            $image = $request->file('article_cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path =  $image->storeAs('images/explore', $imageName, 'public');
        }

        $explore = Explore::create([
            'article_cover' =>  $path,
            'tags' =>  $request->tags,
            'title_en' => $request->title_en,
            'title_ar' =>  $request->title_ar,
            'content_en' =>  $request->content_en,
            'content_ar' =>  $request->content_ar,
            'date' => $request->date,
        ]);

        if ($request->has('tags') && $request->input('tags') === 'Events') {
            $explore->section = $request->input('section');
        }

        $explore->save();

        return new ExploreResource($explore);
    }


    public function show(Explore $explore)
    {
        return new ExploreResource($explore);
    }


    public function update(UpdateRequest $request, Explore $explore)
    {
        $data = $request->validated();


        if ($request->hasFile('article_cover') && $request->file('article_cover')->isValid()) {

            Storage::disk('public')->delete('images/explore' . $explore->image);
            $newImage = $request->file('article_cover');
            $newImageName = time() . '_' . $newImage->getClientOriginalName();
            $path = $newImage->storeAs('images/explore', $newImageName, 'public');
            $explore->article_cover = $path;
        }
        $explore->update($data);

        return new ExploreResource($explore);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Explore $explore)
    {
        Explore::findOrFail($explore->id);
        if ($explore) {
            $explore->delete();
            return response()->json([
                'message' => 'Article deleted successfuly!',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid ID!',
            ], 404);
        }
    }
}
