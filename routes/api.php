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
Route::get('/showreguser', [UserController::class,'showregUser']);
Route::put('/updateuser/{id}', [UserController::class,'updateUser']);
Route::get('/get-total-message/{id}', [UserController::class,'getTotalMessage']);


