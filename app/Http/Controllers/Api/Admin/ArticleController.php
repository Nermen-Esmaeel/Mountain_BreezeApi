<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\{Article, Image, Tag};
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use App\Traits\{UploadFile, ApiResponseTrait};
use App\Http\Requests\Article\{StoreArticle, UpdateArticle};
use App\Http\Resources\{ArticleResource,ArticleVideoResource};


class ArticleController extends Controller
{
    use ApiResponseTrait, UploadFile;

    //Show All Article
    public function index(Request $request)
    {


        $articles = Article::query()->orderBy('id', 'Desc')->paginate(6);
        if ($request->category) {
            $articles->where('category', $request->category);
        }
        if ($request->date) {
            $articles->where('date', $request->date);
        }
       return $this->apiResponse(ArticleResource::collection($articles), '', 200);


    }

    //show one article
    public function show($id)
    {
        $article = Article::find($id);

        //fetch  post from database and store in $posts
        if ($article) {

            $article = Article::query()->where('id', '=', $id)->with(['tags', 'images' ,'videos'])->first();

            return $this->apiResponse(new ArticleResource($article), 'ok', 200);
        }
        return $this->apiResponse(null, 'the article not found', 404);
    }

    //store an article
    public function store(StoreArticle $request)
    {

        $input = $request->input();

        if ($request->hasFile('article_cover')) {

            $file_name = $request->file('article_cover')->getClientOriginalName();
            $file_to_store = 'article_images' . '_' . time().$file_name;
            $request->file('article_cover')->storeAs('public/' . 'article_images', $file_to_store);
            $path ='article_images/'.$file_to_store;
        }

        $article = Article::create([
            'article_cover' =>  $path,
            'category' =>  $request->category,
            'title_en' => $request->title_en,
            'title_ar' =>  $request->title_ar,
            'sub_title_en' => $request->sub_title_en,
            'sub_title_ar' =>  $request->sub_title_ar,
            'content_en' =>  $request->content_en,
            'content_ar' =>  $request->content_ar,
            'date' =>  $request->date,

        ]);


        $article->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $file_name = $image->getClientOriginalName();
                $file_to_store = 'article_images' . '_' . time().$file_name;
                $image->storeAs('public/' . 'article_images', $file_to_store);
                $path ='article_images/'.$file_to_store;

                $article->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        //insert video
        if ($videos = $request->videos) {
            foreach ($videos as $video) {
                $article->videos()->create([
                    'link' => $video,
                ]);
            }
        }
        //add tags for Article table
        if ($tags = $request->tags) {
            foreach ($tags as $tag) {
                $tag_id = Tag::where('name', $tag)->get('id');
                $article->tags()->syncWithoutDetaching($tag_id);
            }
        }

        $article = Article::find($article->id)->orderBy('id', 'Desc')->first();

        return $this->apiResponse(new ArticleResource($article), 'Article created successfully', 201);
    }

    //update an article
    public function update(UpdateArticle $request, $id)
    {

        $input = $request->input();
        $article = Article::find($id);

        if ($article) {

                if ($videos = $request->videos) {
                    foreach ($videos as $video) {
                        $article->videos()->update([
                            'link' => $video,
                        ]);
                    }
                }
            $article->update($input);
            if ($request->article_cover) {

                Storage::disk('public')->delete($article->article_cover);
                $file_name = $request->file('article_cover')->getClientOriginalName();
                $file_to_store = 'article_images' . '_' . time().$file_name;
                $request->file('article_cover')->storeAs('public/' . 'article_images', $file_to_store);
                $path ='article_images/'.$file_to_store;

                    $article->update([
                        'article_cover' => $path,
                    ]);
            }


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $file_name = $image->getClientOriginalName();
                    $file_to_store = 'article_images' . '_' . time(). $file_name;
                    $image->storeAs('public/' . 'article_images', $file_to_store);
                    $path ='article_images/'.$file_to_store;

                    $article->images()->update([
                        'image_path' => $path
                    ]);
                }
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
    public function trash()
    {

        $articles = ArticleResource::collection(Article::onlyTrashed()->with(['tags', 'images' ,'videos'])->orderBy('deleted_at', 'desc')->get());
        if ($articles) {
            return $this->apiResponse($articles, null, 200);
        }
        return $this->apiResponse(null, 'No Articles in Trash', 404);
    }


    //restore from trached
    public function restore($id)
    {

        $article = Article::onlyTrashed()->where('id', $id)->first();
        if ($article) {
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

            //check if article have videos
            if ($article->videos()) {

                foreach ( $article->videos as $video){
                    $article->videos()->delete();
                }
            }
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
                $tag_id = Tag::where('name', $tag_name)->get('id');

                if ($tag_id) {
                    //detach : delete tag from post
                    $article->tags()->detach($tag->id);
                    return $this->apiResponse(null, 'the tag deleted successfuly', 200);
                }
            }
        }
        return $this->apiResponse(null, 'no tag related article', 404);
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
    public function search($term)
    {

        $articles = Article::search($term)->get();
        if (count($articles)) {
            return $this->apiResponse($articles, 'ok', 200);
        } else {
            return $this->apiResponse(null, 'There is no Article  like ' . $term, 404);
        }
    }
    // //show all category
    // public function getCategory()
    // {
    //     //return catagories in array
    //     $categories =  Article::groupBy('category')->pluck('category')->toArray();
    //     return $this->apiResponse($categories, '', 200);
    // }
}
