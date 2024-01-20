<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\authcontroller;
use App\Http\Controllers\API\categorycontroller;
use App\Http\Controllers\API\Newscontroller;
use App\Http\Controllers\categorycontroller as ControllersCategorycontroller;

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
Route::group(["namespace"=>"API"],function(){
    Route::post('/login', [authcontroller::class,'login']);
    Route::group(["middleware"=>"verfiytoken"],function(){
        Route::post('/logout', [authcontroller::class,'logout']);
    });

});
Route::group(["prefix" => "categories", "middleware" => ["changelanguage"]], function () {
    Route::get('/', [CategoryController::class,'index']);

});
Route::group(["prefix" => "news", "middleware" => ["changelanguage"]], function () {

    Route::get('/', [Newscontroller::class,'index']);


});




