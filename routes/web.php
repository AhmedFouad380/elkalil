<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin/dashboard');
});
Route::get('/public_setting', function () {
    return view('admin/setting/public_setting');
});
Route::get('/employee_setting', function () {
    return view('admin/setting/employee_setting');
});
Route::get('/login', function () {
    return view('auth/login');
});

Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);
