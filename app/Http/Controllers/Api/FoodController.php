<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\FoodResource;
use App\Http\Requests\{StoreFood ,UpdateFood };


class FoodController extends Controller
{
    use ApiResponseTrait ;


     //Show All foods
     public function index()
     {
        $foods  = FoodResource::collection(Food::query()
        ->Select('image')
        ->addSelect('category_' . request()->header('language') .' as category')
        ->addSelect('title_' . request()->header('language') . ' as title')
        ->addSelect('content_' . request()->header('language') .' as content')
        ->addSelect('image_size')
        ->addSelect('created_at')
        ->addSelect('updated_at')
        ->get());

      
         return $this->apiResponse($foods ,'' ,200);
     }

    //show one food
    public function show($id)
    {
        $food = Food::query()
        ->where('id', '=', $id)
        ->Select('image')
        ->addSelect('category_' . request()->header('language') .' as category')
        ->addSelect('title_' . request()->header('language') . ' as title')
        ->addSelect('content_' . request()->header('language') . ' as content')
        ->addSelect('image_size')->get();
       
        if($food) {
            return $this->apiResponse($food, 'ok', 200);
        }
        return $this->apiResponse(null, 'the food not found', 404);
    }



    //store an food
    public function store(StoreFood $request)
    {
        
            $input = $request->input();
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
                    'image' => $request->image->getClientOriginalName(),
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

       if($food) {
           $food->update($input);
           if ($request->image) {
            $food->update([
                'image' => $request->image->getClientOriginalName(),
                'image_size' =>  $input['image_size'],
            ]);
        }

           return $this->apiResponse($food, 'the food updated successfully ', 201);
       }
       return $this->apiResponse(null, 'the food not found', 404);
   }

    //delete an article
    public function destroy($id)
    {
        $food = Food::find($id);
        if($food) {

            $food->delete($id);
            return $this->apiResponse(null, 'the food deleted successfully', 200);
        }

        return $this->apiResponse(null, 'the food not found', 404);
    }
}



