<?php

use App\Http\Controllers\UserController;
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

Route::post('/login', [UserController::class,'login']);
Route::post('/register', [UserController::class,'register']);
Route::post('/send-sms', [UserController::class,'sendSMS']);
Route::get('/show', [UserController::class,'show']);

Route::group(['prefix'=>'user'], function(){
    Route::get('/show', [UserController::class,'showUsers']);
    Route::get('/update', [UserController::class,'updateUserPrivilege']);
});

