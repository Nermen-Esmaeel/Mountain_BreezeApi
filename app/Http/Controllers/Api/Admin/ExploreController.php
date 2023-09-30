<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tag;
use App\Models\Explore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExploreResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Explore\StoreRequest;
use App\Http\Requests\Explore\UpdateRequest;

class ExploreController extends Controller
{

    public function index(Request $request)
    {
        $rules = [
            'category' => 'in:Events,Nature,Activity,Chalet,Restaurant,Pool',
        ];

        $validator = Validator::make($request->query(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $exploreQuery = Explore::query();

        if ($request->category) {
            $exploreQuery = $exploreQuery->where('category', 'LIKE', '%' . $request->category . '%');
        }
        return ExploreResource::collection($exploreQuery->get());
    }


    public function store(StoreRequest $request)
    {
        $request->validated();

        if ($request->hasFile('article_cover') && $request->file('article_cover')->isValid()) {

            $file_name = $request->file('article_cover')->getClientOriginalName();
            $file_to_store = 'explore_images' . '_' . time().$file_name;
            $request->file('article_cover')->storeAs('public/' . 'explore_images', $file_to_store);
            $path ='explore_images/'.$file_to_store;
        }


        $explore = Explore::create([
            'article_cover' =>  $path,
            'category' =>  $request->category,
            'title_en' => $request->title_en,
            'title_ar' =>  $request->title_ar,
            'sub_title_en' => $request->sub_title_en,
            'sub_title_ar' =>  $request->sub_title_ar,
            'content_en' =>  $request->content_en,
            'content_ar' =>  $request->content_ar,
            'date' => $request->date,

        ]);


        if ($request->hasFile('images')) {

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $file_name = $image->getClientOriginalName();
                    $file_to_store = 'explore_images' . '_' . time().$file_name;
                    $image->storeAs('public/' . 'explore_images', $file_to_store);
                    $path ='explore_images/'.$file_to_store;

                    $explore->images()->create([
                        'image_path' => $path,
                    ]);
                }
            }
        }

            //insert video
            if ($videos = $request->videos) {

            foreach ($videos as $video) {
                $explore->videos()->create([
                    'link' => $video,
                ]);
            }
        }

        //add tags for Explore table
        if ($tags = $request->tags) {
            foreach ($tags as $tag) {
                $tag_id = Tag::where('name', $tag)->get('id');
                $explore->tags()->syncWithoutDetaching($tag_id);
            }
        }
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

            Storage::disk('public')->delete($explore->image);
            $file_name = $request->file('explore_images')->getClientOriginalName();
            $file_to_store = 'explore_images' . '_' . time() .$file_name;
            $request->file('article_cover')->storeAs('public/' . 'explore_images', $file_to_store);
            $path ='explore_images/'.$file_to_store;
            $data['article_cover'] = $path;
        }



        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $file_name = $image->getClientOriginalName();
                $file_to_store = 'explore_images' . '_' . time().$file_name;
                $image->storeAs('public/' . 'explore_images', $file_to_store);
                $path ='explore_images/'.$file_to_store;

                $explore->images()->update([
                    'image_path' => $path
                ]);
            }
        }

        if ($videos = $request->videos) {
            foreach ($videos as $video) {
                $explore->videos()->update([
                    'link' => $video,
                ]);
            }
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
             //check if article have videos
             if ($explore->videos()) {

                foreach ( $explore->videos as $video){
                    $explore->videos()->delete();
                }
            }
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


    //show tags for Article
    public function showArticleTag($id)
    {

        $explore = Explore::find($id);
        if ($explore) {
            return  $explore->load('tags');
        }
        return response()->json([
            'message' => 'Invalid ID!',
        ], 404);
    }
}
