<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\{Article, Image, Tag};
use App\Http\Resources\CategoryResource;
use App\Traits\{UploadFile, ApiResponseTrait};
use App\Http\Resources\{ArticleResource,TagResource};
use App\Http\Requests\Article\{StoreArticle, UpdateArticle};


class ArticleController extends Controller
{
    use ApiResponseTrait, UploadFile;

    //Show All Article
    public function index(Request $request)
    {


        $articles = Article::query();
        if($request->category){
             $articles->where('category', $request->category );
            }
        if($request->date){
            $articles->where('date', $request->date);
        }
         return $this->apiResponse(ArticleResource::collection($articles->with(['tags' , 'images'])->get()), '', 200);

    }

    //show one article
    public function show($id)
    {
        $article = Article::find($id);

        //fetch  post from database and store in $posts
        if ($article) {

            $article = Article::query()->where('id', '=', $id)->with(['tags' , 'images'])->first();

            return $this->apiResponse(new ArticleResource($article), 'ok', 200);
        }
        return $this->apiResponse(null, 'the article not found', 404);
    }

    //store an article
    public function store(StoreArticle $request)
    {

        $input = $request->input();

        if ($request->hasFile('article_cover')) {

            $path = $this->UploadFile('Article_Covers', $request->file('article_cover'));
        }

        $article = Article::create([
            'article_cover' =>  $path,
            'category' =>  $input['category'],
            'title_en' => $input['title_en'],
            'title_ar' =>  $input['title_ar'],
            'sub_title_en' => $input['sub_title_en'],
            'sub_title_ar' =>  $input['sub_title_ar'],
            'content_en' =>  $input['content_en'],
            'content_ar' =>  $input['content_ar'],
            'date' =>  $input['date'],

        ]);


        $article->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('images/article', $filename);

                $article->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        //add tags for Article table
        if ($tags = $request->tags) {
            foreach ($tags as $tag) {
                $tag_id =Tag::where('name',$tag)->get('id');
              $article->tags()->syncWithoutDetaching($tag_id);

            }
        }

        $article = Article::find($article->id)->with(['images'])->orderBy('id', 'Desc')->first();


        return $this->apiResponse(new ArticleResource($article), 'Article created successfully', 201);
    }

    //update an article
    public function update(UpdateArticle $request, $id)
    {
        $input = $request->input();
        $article = Article::find($id);
        if ($article) {

            $article->update($input);
            if ($request->article_cover) {

                $path = $this->UploadFile('Article_Covers', $request->file('article_cover'));
                File::delete(public_path() . '/' . $article->article_cover);

                $article->update([
                    'article_cover' => $path,
                ]);
            }
            return $this->apiResponse(new ArticleResource($article), 'the article updated successfully ', 201);
        }
        return $this->apiResponse(null, 'the article not found', 404);
    }



    //soft delete
    public function SoftDelete($id)
    {
        $article = Article::find($id);
        if ($article) {

            $article->delete($id);
            return $this->apiResponse(null, 'the Article  Moved to Trash successfully', 200);
        }

        return $this->apiResponse(null, 'the Article not found', 404);
    }


    //show trash
    public function trash(){

            $articles = ArticleResource::collection(Article::onlyTrashed()->orderBy('deleted_at', 'desc')->get());
            if ($articles) {
                return $this->apiResponse($articles, null , 200);
            }
            return $this->apiResponse(null, 'No Articles in Trash', 404);
    }


    //restore from trached
    public function restore($id){

        $article = Article::onlyTrashed()->where('id' , $id)->first();
        if ($article){
            $article->restore();
            return $this->apiResponse(null, 'Article restore successfully', 201);
        }
        return $this->apiResponse(null, 'the Article not found in trash', 404);

    }


    //delete an article
    public function forceDelete($id)
    {
        $article = Article::onlyTrashed()->where('id', $id)->first();
        if ($article) {

          //  File::delete(public_path() . '/' . $article->article_cover);
            $article->tags()->detach();
            $article->forcedelete();
            return $this->apiResponse(null, 'the Article deleted successfully', 200);
        }

        return $this->apiResponse(null, 'the Article not found', 404);
    }


    //delete Tag from Article
    public function deleteTagFormArticle(Request $request, $id)
    {
        $tag_name = $request->tags;
        //store post's tags
        $article = Article::find($id);
        if ($article->tags) {
            foreach ($article->tags as $tag) {
                $tag_id =Tag::where('name',$tag->name)->get('id');
                if( $tag_id){
                    //detach : delete tag from post
                    $article->tags()->detach($tag->id);
                    return $this->apiResponse(null, 'the tag deleted successfuly', 200);
                }
            }
        }
        return $this->apiResponse(null, 'the Article not found', 404);
    }

    //show tags for Article
    public function showArticleTag($id)
    {

        $article = Article::find($id);
        if ($article) {
            return  $article->load('tags');
        }
        return $this->apiResponse(null, 'the Article not found', 404);
    }


       //search
       public function search($term){

        $articles = Article::search($term)->get();
        if(count($articles)){
            return $this->apiResponse($articles, 'ok', 200);
           }else{
            return $this->apiResponse(null, 'There is no Article  like '.$term , 404);
           }
        }
        //show all category
        public function getCategory()
        {
            //return catagories in array
            $categories =  Article::groupBy('category')->pluck('category')->toArray();
            return $this->apiResponse($categories, '', 200);
    }

    }




