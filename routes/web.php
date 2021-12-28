<?php

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\PageController;
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
Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/store_event', [\App\Http\Controllers\DashboardController::class, 'store_event']);

});


Route::get('public_setting', [SettingsController::class, 'Settings']);
Route::post('edit_setting', [SettingsController::class, 'editSettings']);


//employee settings
Route::get('employee_setting', [UsersController::class, 'index']);
Route::get('employee_datatable', [UsersController::class, 'datatable'])->name('employee.datatable.data');
Route::get('delete-user', [UsersController::class, 'destroy']);
Route::get('get-branch/{id}', [UsersController::class, 'getBranch']);
Route::get('delete-user', [UsersController::class, 'destroy']);
Route::post('store-employee', [UsersController::class, 'store']);
Route::get('employee-edit/{id}', [UsersController::class, 'edit']);
Route::post('update-employee', [UsersController::class, 'update']);
Route::get('/add-button', function () {return view('admin/setting/employee/button');});


//Requests settings
Route::get('Requests', [\App\Http\Controllers\Admin\RequestsController::class, 'index']);
Route::get('Requests_datatable', [\App\Http\Controllers\Admin\RequestsController::class, 'datatable'])->name('Requests.datatable.data');
Route::get('delete-user', [\App\Http\Controllers\Admin\RequestsController::class, 'destroy']);
Route::get('get-branch/{id}', [\App\Http\Controllers\Admin\RequestsController::class, 'getBranch']);
Route::get('delete-user', [\App\Http\Controllers\Admin\RequestsController::class, 'destroy']);
Route::post('store-employee', [\App\Http\Controllers\Admin\RequestsController::class, 'store']);
Route::get('employee-edit/{id}', [\App\Http\Controllers\Admin\RequestsController::class, 'edit']);
Route::post('update-employee', [\App\Http\Controllers\Admin\RequestsController::class, 'update']);
Route::get('/add-button', function () {return view('admin/setting/employee/button');});


//end employee settings


Route::get('/quest', function () {
    return view('auth/request');
});
Route::post('/quest', 'App\Http\Controllers\Front\PageController@store_quest')->name('create_quest.submit');
Route::get('success_msg', [PageController::class, 'success_msg']);

Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('/table', function () {
    return view('admin/table');
});

Route::get('/projects', function () {
    return view('admin/projects');
});
