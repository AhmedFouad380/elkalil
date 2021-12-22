<?php

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
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
Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);


Route::get('public_setting', [SettingsController::class, 'Settings']);
Route::post('edit_setting', [SettingsController::class, 'editSettings']);


Route::get('/employee_setting', function () {
    return view('admin/setting/employee_setting');
});

//employee settings
Route::get('employee_setting', [UsersController::class, 'index']);
Route::get('employee_datatable', [UsersController::class, 'datatable'])->name('employee.datatable.data');
Route::get('delete-user', [UsersController::class, 'destroy']);
Route::get('get-branch/{id}', [UsersController::class, 'getBranch']);
Route::get('delete-user', [UsersController::class, 'destroy']);
Route::post('store-employee', [UsersController::class, 'store']);
Route::get('employee-edit/{id}', [UsersController::class, 'edit']);
Route::post('update-employee', [UsersController::class, 'update']);


//end employee settings

Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/request', function () {
    return view('auth/request');
});


Route::post('login', [AuthController::class, 'login']);
