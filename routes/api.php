<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [UserController::Class, 'register']);
Route::post('/login', [UserController::Class, 'login']);

//protected routes
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'taskmanager'], function () {

    Route::get('/profile' , [UserController::class, 'profile']);
    Route::get('/tasks', [TaskController::class, 'all']);
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);

    Route::post('task/create', [TaskController::class, 'store']);
});

