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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('user')->group(function () {
    Route::post('/register', [UserController::Class, 'register']);
    Route::post('/login', [UserController::Class, 'login']);
});

//protected routes
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'taskmanager'], function () {

    Route::get('/users', [UserController::class, 'allUsers']);
     Route::put('user/update/{id}', [UserController::class, 'update']);
    Route::get('user/profile' , [UserController::class, 'profile']);
    Route::get('user/show/{id}', [UserController::class, 'show']);
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::get('/tasks', [TaskController::class, 'all']);
    Route::get('task/show/{id}', [TaskController::class, 'show']);
    Route::post('task/create', [TaskController::class, 'store']);
    Route::put('task/update/{id}', [TaskController::class, 'update']);
    Route::delete('task/delete/{id}', [TaskController::class, 'destroy']);
});

