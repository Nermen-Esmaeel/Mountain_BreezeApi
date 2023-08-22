<?php

use App\Http\Controllers\Api\Admin\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\Auth\AuthController;

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
Route::prefix('dashboard')->group(function () {


    //Article Route
    Route::group([
        'prefix' => '/articles',
    ], function () {
        Route::get('/', [ArticleController::class, 'index']);
        Route::get('/{id}', [ArticleController::class, 'show']);
        Route::post('/', [ArticleController::class, 'store']);
        Route::post('/{id}', [ArticleController::class, 'update']);
        Route::delete('/{id}', [ArticleController::class, 'destroy']);

    });

    //Post Tag Routes
    Route::group([
        'prefix' => '/article.tags',
    ], function () {

            Route::post('/{id}' , [ArticleController::class , 'deleteTagFormArticle']);
            Route::get('/{id}' , [ArticleController::class , 'showArticleTag']);
    });

    //Food Route
    Route::group([
        'prefix' => '/foods',
    ], function () {
        Route::get('/', [FoodController::class, 'index']);
        Route::get('/{id}', [FoodController::class, 'show']);
        Route::post('/', [FoodController::class, 'store']);
        Route::post('/{id}', [FoodController::class, 'update']);
        Route::delete('/{id}', [FoodController::class, 'destroy']);

    });

    //Food Route
    Route::group([
        'prefix' => '/books',
    ], function () {
        Route::get('/', [BookController::class, 'index']);

    });



    //Rooms
    Route::resource('rooms', RoomController::class);


//end perfix dashboard
});

Route::group([
    'prefix' => '/books',
], function () {
    Route::get('/', [BookController::class, 'index']);

});