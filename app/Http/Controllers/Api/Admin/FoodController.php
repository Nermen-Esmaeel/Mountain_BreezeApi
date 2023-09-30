<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Food;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Food\{StoreFood, UpdateFood};


class FoodController extends Controller
{
    use ApiResponseTrait, UploadFile;


    //Show All foods
    public function index(Request $request)
    {

        $foods = Food::query();
        if ($request->category) {
            $foods->where('category', $request->category);
        }

        return $this->apiResponse(FoodResource::collection($foods->get()), '', 200);
    }

    //show one food
    public function show($id)
    {
        $food = Food::find($id);
        if ($food) {
            return $this->apiResponse(new FoodResource($food), 'ok', 200);
        }
        return $this->apiResponse(null, 'the food not found', 404);
    }



    //store an food
    public function store(StoreFood $request)
    {

        $input = $request->input();
        if ($request->hasFile('image')) {

            $file_name =  $request->file('image')->getClientOriginalName();
            $file_to_store = 'food_images' . '_' . time().$file_name;
            $request->file('image')->storeAs('public/' . 'food_images', $file_to_store);
            $path ='food_images/'.$file_to_store;

        }
        $food = Food::create([

            'category' =>  $input['category'],
            'title_en' => $input['title_en'],
            'title_ar' =>  $input['title_ar'],
            'content_en' =>  $input['content_en'],
            'content_ar' =>  $input['content_ar'],
        ]);

        if ($request->image) {

            $food->update([
                'image' => $path,
                'image_size' =>  $input['image_size'],
            ]);
        }

        $food = Food::find($food->id);
        return $this->apiResponse(new FoodResource($food), 'Food created successfully', 201);
    }


    //update an article
    public function update(UpdateFood $request, $id)
    {



        $input = $request->input();
        $food = Food::find($id);

        if ($food) {
            $food->update($input);

            if ($request->hasFile('image')) {

                $image = $request->file('image');

                Storage::disk('public')->delete($food->image);

                $file_name = $image->getClientOriginalName();
                $file_to_store = 'food_images' . '_' . time().$file_name;
                $image->storeAs('public/' . 'food_images', $file_to_store);
                $path ='food_images/'.$file_to_store;


                $food->update([
                    'image' => $path,
                    'image_size' =>  $request->image_size,
                ]);
            }
            return $this->apiResponse(new FoodResource($food), 'the food updated successfully ', 201);
        }

        return $this->apiResponse(null, 'the food not found', 404);
    }





    //delete an food
    public function forceDelete($id)
    {
        $food = Food::find($id);
        if ($food) {

            // File::delete(public_path() . '/' . $food->image);
            $food->delete();
            return $this->apiResponse(null, 'the food deleted successfully', 200);
        }

        return $this->apiResponse(null, 'the food not found', 404);
    }

    //search
    public function search($term)
    {

        $foods = Food::search($term)->get();
        if (count($foods)) {
            return $this->apiResponse($foods, 'ok', 200);
        } else {
            return $this->apiResponse(null, 'There is no Food  like ' . $term, 404);
        }
    }
}
