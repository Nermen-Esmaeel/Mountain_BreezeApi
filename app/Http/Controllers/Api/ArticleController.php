<?php

namespace App\Http\Controllers\Api;

use App\Models\{Article , Image , Tag} ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\{StoreArticle , UpdateArticle};


class ArticleController extends Controller
{
    use ApiResponseTrait;

    //Show All Article
    public function index()
    {
        $articles = ArticleResource::collection(Article::get());
        return $this->apiResponse($articles,'' ,200);
    }

    //show one article
    public function show($id)
    {
        //fetch  post from database and store in $posts

        $article = Article::find($id);
        if($article) {
            return $this->apiResponse(new ArticleResource($article), 'ok', 200);
        }
        return $this->apiResponse(null, 'the post not found', 404);
    }

      //store an article
      public function store(StoreArticle $request)
      {

        $input = $request->input();

        $article = Article::create([
            'article_cover' => $input['article_cover'],
            'category' =>  $input['category'],
            'title' =>  $input['title'],
            'content' =>  $input['content'],
            'date' =>  $input['date'],
        ]);

          $article->save();

          if ($images=$request->images) {

            foreach ($images as $image) {

                $image = Image::create([
                    'image' => $image->getClientOriginalName(),
                    'article_id' => $article->id,
                ]);
                $image->save();
            }

        }
        //add tags for tags_table
        if($tags= $request->tags){

            foreach ($tags as $tag) {
                $tag = Tag::create([
                    'name' => $tag,
                ]);
                $tag->save();
          //add tags for Article table
                $article->tags()->syncWithoutDetaching($tag->id);

            }

        }

        $article = Article::find($article->id)->with(['images'])->first();
      return $this->apiResponse(new ArticleResource($article), 'Article created successfully', 201);

      }

   //update an article
    public function update(UpdateArticle $request, $id)
    {
        $input = $request->input();
        $article = Article::find($id);

        if($article) {
            $article->update($input);

            return $this->apiResponse(new ArticleResource($article), 'the article updated successfully ', 201);
        }
        return $this->apiResponse(null, 'the article not found', 404);
    }
    //delete an article
    public function destroy($id)
    {
    $article = Article::find($id);
    if($article) {

        $article->delete($id);
        $article->tags()->detach();
        return $this->apiResponse(null, 'the Article deleted successfully', 200);
    }

    return $this->apiResponse(null, 'the Article not found', 404);

}


//delete Tag from Article
public function deleteTagFormArticle(Request $request , $id){

    $tag_name = $request->tags;
    //store post's tags
    $article = Article::find($id);
    if($article){
        $i= 0;
        foreach($article->tags as $tag){
               if($tag->name == $tag_name[$i]){
                 //detach : delete tag from post
                $article->tags()->detach($tag->id);
               }
               $i++;
        }
        return $this->apiResponse( null,'the tag deleted successfuly', 200);
    }
    return $this->apiResponse(null, 'the Article not found', 404);
}

//show tags for Article
public function showArticleTag($id){

  $article = Article::find($id);
    if($article){
         return  $article->load('tags');
    }
    return $this->apiResponse(null, 'the Article not found', 404);
}
}
