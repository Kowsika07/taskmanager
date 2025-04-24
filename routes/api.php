<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('tasklist',[TaskController::class,'index']);
Route::post('store',[TaskController::class,'store']);
Route::put('update/{id}',[TaskController::class,'update']);
Route::delete('delete/{id}',[TaskController::class,'destroy']);
Route::get('status/{id}',[TaskController::class,'status']);

Route::middleware('auth:sanctum')->group(function () {
    // Get authenticated user
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
   
     Route::post('edit/{id}',[TaskController::class,'edit']);


});