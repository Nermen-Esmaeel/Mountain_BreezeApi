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
        $articles  = ArticleResource::collection(Article::query()
        ->Select('article_cover')
        ->addSelect('category_' . request()->header('language') .' as category')
        ->addSelect('title_' . request()->header('language') . ' as title')
        ->addSelect('content_' . request()->header('language') .' as content')
        ->addSelect('date')
        ->addSelect('created_at')
        ->addSelect('updated_at')
        ->get());
        return $this->apiResponse($articles,'' ,200);
    }

    //show one article
    public function show($id)
    {
        $article = Article::find($id);
      
        //fetch  post from database and store in $posts
        if($article) {

            $article = ArticleResource::collection(Article::query()
            ->where('id', '=', $id)
            ->Select('article_cover')
            ->addSelect('category_' . request()->header('language') .' as category')
            ->addSelect('title_' . request()->header('language') . ' as title')
            ->addSelect('content_' . request()->header('language') . ' as content')
            ->addSelect('date')
            ->addSelect('created_at')
            ->addSelect('updated_at')
            ->get());

            return $this->apiResponse($article, 'ok', 200);
        }
        return $this->apiResponse(null, 'the article not found', 404);
    }

      //store an article
      public function store(StoreArticle $request)
      {
        $input = $request->input();
        $article = Article::create([
            'article_cover' => $request->article_cover->getClientOriginalName() ,
            'category_en' =>  $input['category_en'],
            'category_ar' =>  $input['category_ar'],
            'title_en' => $input['title_en'],
            'title_ar' =>  $input['title_ar'],
            'content_en' =>  $input['content_en'],
            'content_ar' =>  $input['content_ar'],
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

        $article = Article::find($article->id)->with(['images'])->latest()->first();

      return $this->apiResponse($article, 'Article created successfully', 201);

      }

   //update an article
    public function update(UpdateArticle $request, $id)
    {
        $input = $request->input();
        $article = Article::find($id)->with(['images'])->latest()->first();

        if($article) {

            $article->update($input);
            if ($request->article_cover) {
                $article->update([
                    'article_cover' => $request->article_cover->getClientOriginalName(),
                ]);
            }
            return $this->apiResponse($article, 'the article updated successfully ', 201);
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
