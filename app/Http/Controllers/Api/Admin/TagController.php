<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;

class TagController extends Controller
{
    use ApiResponseTrait;

    //show all tags
    public function index()
    {

        $tags = Tag::all();
        return $this->apiResponse(TagResource::collection($tags), '', 200);
    }

       //store a tags
       public function store(Request $request)
       {

        $validate = $this->validate($request, [
                'name' => 'required',
            ]);

            $input = $request->input();
            $tag = Tag::create([
                'name' =>  $input['name'],
            ]);
            $tag->save();

            $tag = Tag::find($tag->id)->orderBy('id', 'Desc')->first();
            return $this->apiResponse(new TagResource($article), 'tag created successfully', 201);

       }

    //update an tag
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->input();
        $tag =  tag::find($id);
        if ($tag) {

            $tag->update($input);

            return $this->apiResponse(new TagResource($tag), 'tag updated successfully ', 201);
        }
        return $this->apiResponse(null, 'the tag not found', 404);
    }


      //delete a tag
      public function destroy($id)
      {
          $tag = tag::find($id);
          if($tag) {

              $tag->delete($id);
              return $this->apiResponse(null, ' tag deleted successfully', 200);
          }

          return $this->apiResponse(null, ' tag not found', 404);

      }
}
