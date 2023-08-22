<?php

use App\Http\Controllers\Api\Admin\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\Auth\AuthControler;
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



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});

Route::prefix('dashboard')->group(function () {


    //Article Route
    Route::resource('articles', ArticleController::class);

    /**************     Post Tag Routes    *************/
    Route::prefix('/article.tags')->group(function () {

        Route::post('/{id}', [ArticleController::class, 'deleteTagFormArticle']);
        Route::get('/{id}', [ArticleController::class, 'showArticleTag']);
    });

    //Rooms
    Route::resource('rooms', RoomController::class);
});
