<?php

<<<<<<< HEAD
use App\Http\Controllers\Api\Admin\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\Auth\AuthController;

=======
use App\Http\Controllers\Api\Admin\ExploreController;
use App\Http\Controllers\Api\Admin\GalaryController;
use App\Http\Controllers\Api\Admin\RoomController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ArticleController;
use App\Http\Controllers\Api\Admin\FoodController;
use App\Http\Controllers\Api\Admin\BookController;
use App\Http\Controllers\Api\Auth\AuthController;


>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
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

<<<<<<< HEAD
    //Auth Routes
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
    });

//start perfix dashboard
Route::prefix('dashboard')->group(function () {
=======
//Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

//start perfix dashboard
Route::prefix('dashboard')->middleware('auth:api')->group(function () {
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)


    //Article Route
    Route::group([
        'prefix' => '/articles',
    ], function () {
        Route::get('/', [ArticleController::class, 'index']);
        Route::get('/{id}', [ArticleController::class, 'show']);
        Route::post('/', [ArticleController::class, 'store']);
        Route::post('/{id}', [ArticleController::class, 'update']);
        Route::delete('/{id}', [ArticleController::class, 'destroy']);
<<<<<<< HEAD

=======
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
    });

    //Post Tag Routes
    Route::group([
        'prefix' => '/article.tags',
    ], function () {

<<<<<<< HEAD
            Route::post('/{id}' , [ArticleController::class , 'deleteTagFormArticle']);
            Route::get('/{id}' , [ArticleController::class , 'showArticleTag']);
=======
        Route::post('/{id}', [ArticleController::class, 'deleteTagFormArticle']);
        Route::get('/{id}', [ArticleController::class, 'showArticleTag']);
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
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
<<<<<<< HEAD

=======
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
    });

    //Food Route
    Route::group([
        'prefix' => '/books',
    ], function () {
        Route::get('/', [BookController::class, 'index']);
<<<<<<< HEAD

=======
        Route::get('/room', [BookController::class, 'getAvailableRoom'])->middleware('chechBooking');
        Route::post('/', [BookController::class, 'store']);
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
    });



    //Rooms
    Route::resource('rooms', RoomController::class);


<<<<<<< HEAD
//end perfix dashboard
});

=======
    //Galary
    Route::post('galary', [GalaryController::class, 'storeImages']);
    Route::get('galary', [GalaryController::class, 'filteredImages']);
    Route::post('videos', [GalaryController::class, 'storeVideos']);
    Route::get('videos', [GalaryController::class, 'filteredVideos']);

    //explore
    Route::get('explores/article', [ExploreController::class, 'filteredExplore']);
    Route::resource('explores', ExploreController::class);
});
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
