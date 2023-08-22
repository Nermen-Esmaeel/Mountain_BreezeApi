<?php

use App\Http\Controllers\Api\Admin\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

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



//Article Route
Route::group([
    'prefix' => '/articles',
], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::post('/', [ArticleController::class, 'store']);
    Route::put('/{id}', [ArticleController::class, 'update']);
    Route::delete('/{id}', [ArticleController::class, 'destroy']);

});

/**************     Post Tag Routes    *************/
Route::group([
    'prefix' => '/article.tags',
], function () {

          Route::post('/{id}' , [ArticleController::class , 'deleteTagFormArticle']);
          Route::get('/{id}' , [ArticleController::class , 'showArticleTag']);
});
