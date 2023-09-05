<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Food;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\FoodResource;
use App\Http\Requests\Food\{StoreFood, UpdateFood};
use App\Traits\UploadFile;
use Illuminate\Support\Facades\File;


class FoodController extends Controller
{
    use ApiResponseTrait, UploadFile;


    //Show All foods
    public function index()
    {
        $foods  = FoodResource::collection(Food::query()->get());


        return $this->apiResponse($foods, '', 200);
    }

    //show one food
    public function show($id)
    {
        $food = Food::query()->where('id', '=', $id)->first();

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
            $path = $this->UploadFile('Foods' , $request->file('image'));
        }
        $food = Food::create([

            'category_en' =>  $input['category_en'],
            'category_ar' =>  $input['category_ar'],
            'title_en' => $input['title_en'],
            'title_ar' =>  $input['title_ar'],
            'content_en' =>  $input['content_en'],
            'content_ar' =>  $input['content_ar'],
        ]);

        if ($request->image) {

            $food->update([
                'image' => $path ,
                'image_size' =>  $input['image_size'],
            ]);
        }

        $food = Food::find($food->id);
        return $this->apiResponse($food, 'Food created successfully', 201);
    }


    //update an article
    public function update(UpdateFood $request, $id)
    {


        $input = $request->input();
        $food = Food::find($id);

        if ($food) {
            $food->update($input);

            if ($request->hasFile('image')) {

                $path = $this->UploadFile('images/foods', $request->file('image'));
                File::delete(public_path() . '/' . $food->image);
                $food->update([
                    'image' => $path,
                    'image_size' =>  $input['image_size'],
                ]);
            }
            return $this->apiResponse($food, 'the food updated successfully ', 201);
        }

        return $this->apiResponse(null, 'the food not found', 404);
    }



    //soft delete
    public function SoftDelete($id)
    {
        $food = Food::find($id);
        if ($food) {

            $food->delete($id);
            return $this->apiResponse(null, ' Food  Moved to Trash successfully', 200);
        }

        return $this->apiResponse(null, ' Food not found', 404);
    }


    //show trash
    public function trash(){

            $foods = Food::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
            if ($foods) {
                return $this->apiResponse($foods, null , 200);
            }
            return $this->apiResponse(null, 'No Foods in Trash', 404);
    }


    //restore from trached
    public function restore($id){


            $food = Food::onlyTrashed()->where('id' , $id)->first()->restore();
            return $this->apiResponse(null, 'Food restore successfully', 201);

    }


    //delete an food
    public function forceDelete($id)
    {
        $food = Food::findOrFail($id);
        if ($food) {

            File::delete(public_path() . '/' . $food->image);
            $food->forcedelete();
            return $this->apiResponse(null, 'the food deleted successfully', 200);
        }

        return $this->apiResponse(null, 'the food not found', 404);
    }


}
