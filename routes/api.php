<?php

use App\Http\Controllers\ApiUserController;
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


Route::get('/api_user/all', [ApiUserController::class, 'list']);
Route::get('/api_user/search', [ApiUserController::class, 'searchApiUsers']);
Route::get('/api_user/show/{id}', [ApiUserController::class, 'show']);
Route::post('/api_user/create', [ApiUserController::class, 'create']);
Route::patch('/api_user/update', [ApiUserController::class, 'update']);
Route::delete('/api_user/delete', [ApiUserController::class, 'delete']);
