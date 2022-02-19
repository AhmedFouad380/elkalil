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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('StoreMessage',['App\Http\Controllers\Admin\ProjectLevelController','StoreChatMobile']);
Route::post('getMessage',['App\Http\Controllers\Admin\ProjectLevelController','getMessage']);

Route::post('AddGeneralSupervisor',['App\Http\Controllers\Api\ProjectController','AddGeneralSupervisor']);
