<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Auth\AuthController;


use App\Http\Controllers\Api\Admin\BookController;
use App\Http\Controllers\Api\Admin\FoodController;
use App\Http\Controllers\Api\Admin\RoomController;
use App\Http\Controllers\Api\Admin\VideoController;
use App\Http\Controllers\Api\Admin\GallaryController;
use App\Http\Controllers\Api\Admin\ArticleController;
use App\Http\Controllers\Api\Admin\ExploreController;
use App\Http\Controllers\Api\Admin\MessageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

//start perfix dashboard
Route::prefix('dashboard')->middleware('auth:api')->group(function () {

    //Blog Article Route
    Route::group([
        'prefix' => '/articles',
    ], function () {
        Route::get('/', [ArticleController::class, 'index'])->withoutMiddleware(['auth:api']);
        Route::get('category/', [ArticleController::class, 'getCategory'])->withoutMiddleware(['auth:api']);
        Route::get('/{id}', [ArticleController::class, 'show'])->withoutMiddleware(['auth:api']);
        Route::post('/', [ArticleController::class, 'store']);
        Route::post('/{id}', [ArticleController::class, 'update']);
        //soft delete
        Route::get('softDelete/{id}', [ArticleController::class, 'SoftDelete']);

        //show trash
        Route::get('/show/Trashed', [ArticleController::class, 'trash']);

        //restore
        Route::get('trash/restore/{id}', [ArticleController::class, 'restore']);

        //Force Delete
        Route::delete('/{id}', [ArticleController::class, 'forceDelete']);


        //search
        Route::get('/search/{term}', [ArticleController::class, 'search']);
    });

    //Post Tag Routes
    Route::group([
        'prefix' => '/article.tags',
    ], function () {
        Route::get('/{id}', [ArticleController::class, 'showArticleTag']);
        Route::post('/{id}', [ArticleController::class, 'deleteTagFormArticle']);
    });

    //Tag Routes
    Route::group([
        'prefix' => '/tags',
    ], function () {
        Route::get('/', [TagController::class, 'index']);
        Route::post('/', [TagController::class, 'store']);
        Route::post('/{id}', [TagController::class, 'update']);
        Route::delete('/{id}', [TagController::class, 'destroy']);
    });

    //Food Route
    Route::group([
        'prefix' => '/foods',
    ], function () {
        Route::get('/', [FoodController::class, 'index'])->withoutMiddleware(['auth:api']);
        Route::get('/{id}', [FoodController::class, 'show'])->withoutMiddleware(['auth:api']);
        Route::post('/', [FoodController::class, 'store']);
        Route::post('/{id}', [FoodController::class, 'update']);
        //soft delete
        Route::get('softDelete/{id}', [FoodController::class, 'SoftDelete']);

        //show trash
        Route::get('/show/Trashed', [FoodController::class, 'trash']);

        //restore
        Route::get('trash/restore/{id}', [FoodController::class, 'restore']);

        //Force Delete
        Route::delete('/{id}', [FoodController::class, 'forceDelete']);

        //search
        Route::get('/search/{term}', [FoodController::class, 'search']);
    });

    //Book Route
    Route::group([
        'prefix' => '/books',
    ], function () {
        Route::get('/', [BookController::class, 'index']);
        Route::post('/', [BookController::class, 'store'])->withoutMiddleware(['auth:api']);
    });

    //gallary/images
    Route::post('gallary', [GallaryController::class, 'store']);
    Route::get('gallary', [GallaryController::class, 'index'])->withoutMiddleware(['auth:api']);

    //video
    Route::post('videos', [VideoController::class, 'store']);
    Route::get('videos', [VideoController::class, 'index'])->withoutMiddleware(['auth:api']);


    //Rooms
    Route::get('rooms', [RoomController::class, 'index'])->withoutMiddleware(['auth:api']);
    Route::post('rooms', [RoomController::class, 'store']);
    Route::post('rooms/{room}', [RoomController::class, 'update']);
    Route::get('rooms/{room}', [RoomController::class, 'show'])->withoutMiddleware(['auth:api']);;
    Route::delete('rooms/{room}', [RoomController::class, 'destroy']);
    //soft delete
    Route::get('rooms/softDelete/{id}', [RoomController::class, 'SoftDelete']);
    //show trash
    Route::get('rooms/show/Trashed', [RoomController::class, 'trash']);
    //restore
    Route::get('rooms/trash/restore/{id}', [RoomController::class, 'restore']);


    //Explore
    Route::get('explores', [ExploreController::class, 'index'])->withoutMiddleware(['auth:api']);;
    Route::post('explores', [ExploreController::class, 'store']);
    Route::post('explores/{explore}', [ExploreController::class, 'update']);
    Route::get('explores/{explore}', [ExploreController::class, 'show'])->withoutMiddleware(['auth:api']);;
    Route::delete('explores/{explore}', [ExploreController::class, 'destroy']);

    Route::get('explores/article.tags/{id}', [ExploreController::class, 'showArticleTag'])->withoutMiddleware(['auth:api']);;


    //contact us Route
    Route::group([
        'prefix' => '/contact',
    ], function () {
        //contact as
        Route::get('/', [MessageController::class, 'index']);
        Route::post('/', [MessageController::class, 'store'])->withoutMiddleware(['auth:api']);

        //soft delete
        Route::get('softDelete/{id}', [MessageController::class, 'SoftDelete']);

        //show trash
        Route::get('/show/Trashed', [MessageController::class, 'trash']);

        //restore
        Route::get('trash/restore/{id}', [MessageController::class, 'restore']);

        //Force Delete
        Route::delete('/{id}', [MessageController::class, 'forceDelete']);
    });
});
