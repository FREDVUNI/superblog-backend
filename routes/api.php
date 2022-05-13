<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(["middleware" => ["auth:api"]],function () {
    Route::get('/categories',[App\Http\Controllers\API\CategoryController::class,'index']);
    Route::group(['prefix' => 'category'], function () {
        Route::post('add', [App\Http\Controllers\API\CategoryController::class,'store']);
        Route::get('edit/{id}', [App\Http\Controllers\API\CategoryController::class,'edit']);
        Route::put('update/{id}', [App\Http\Controllers\API\CategoryController::class,'update']);
        Route::delete('delete/{id}', [App\Http\Controllers\API\CategoryController::class,'delete']);
    });

    Route::get('/posts',[App\Http\Controllers\API\PostController::class,'index']);
    Route::group(['prefix' => 'post'], function () {
        Route::post('add', [App\Http\Controllers\API\PostController::class,'store']);
        Route::get('edit/{id}', [App\Http\Controllers\API\PostController::class,'edit']);
        Route::post('update/{id}', [App\Http\Controllers\API\PostController::class,'update']);
        Route::delete('delete/{id}', [App\Http\Controllers\API\PostController::class,'delete']);
    });
    Route::get("/profile",[App\Http\Controllers\API\ProfileController::class,'index']);
    Route::post("/profile",[App\Http\Controllers\API\ProfileController::class,'update']);
});

Route::get("blogcategories",[App\Http\Controllers\CategoryController::class,"index"]);
Route::get("blogposts",[App\Http\Controllers\PostController::class,"index"]);
Route::get("post/{id}",[App\Http\Controllers\PostController::class,"show"]);
Route::get("category/{id}",[App\Http\Controllers\PostController::class,"post_category"]);
Route::get("latest-posts",[App\Http\Controllers\PostController::class,"latest_posts"]);
Route::post("search-posts",[App\Http\Controllers\PostController::class,"search_posts"]);
