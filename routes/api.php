<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('blog',\App\Http\Controllers\API\BlogController::class);
Route::post('/addCat',[\App\Http\Controllers\API\BlogController::class,'addCat']);
Route::post('/addblog',[\App\Http\Controllers\API\BlogController::class,'store']);
Route::resource('comment',\App\Http\Controllers\API\CommnetController::class);
Route::post('/register', [\App\Http\Controllers\API\AuthController::class,'register']);
Route::post('/login', [\App\Http\Controllers\API\AuthController::class,'login']);