<?php

use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ContractTypesController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\PercentCategoryController;
use App\Http\Controllers\Admin\PercentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\DashboardController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth/login');
    })->name('login');
});

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

Route::middleware('auth_user')->group(function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/home', [DashboardController::class, 'index']);
    Route::get('public_setting', [SettingsController::class, 'Settings']);
    Route::post('edit_setting', [SettingsController::class, 'editSettings']);
//employee settings
    Route::get('employee_setting', [UsersController::class, 'index']);
    Route::get('employee_datatable', [UsersController::class, 'datatable'])->name('employee.datatable.data');
    Route::get('delete-user', [UsersController::class, 'destroy']);
    Route::get('get-branch/{id}', [UsersController::class, 'getBranch']);
    Route::post('store-employee', [UsersController::class, 'store']);
    Route::get('employee-edit/{id}', [UsersController::class, 'edit']);
    Route::post('update-employee', [UsersController::class, 'update']);
    Route::get('/add-button', function () {
        return view('admin/setting/employee/button');
    });
//    permission Settings
    Route::get('permission_setting', [PermissionController::class, 'index']);
    Route::get('permission_datatable', [PermissionController::class, 'datatable'])->name('permission.datatable.data');
    Route::get('delete-permission', [PermissionController::class, 'destroy']);
    Route::post('store-permission', [PermissionController::class, 'store']);
    Route::get('edit-permission/{id}', [PermissionController::class, 'edit']);
    Route::post('update-permission', [PermissionController::class, 'update']);
    Route::get('/add-permission-button', function () {
        return view('admin/setting/UserPermission/button');
    });
//client settings
    Route::get('client_setting', [ClientsController::class, 'index']);
    Route::get('client_datatable', [ClientsController::class, 'datatable'])->name('client.datatable.data');
    Route::get('delete-client', [ClientsController::class, 'destroy']);
    Route::post('store-client', [ClientsController::class, 'store']);
    Route::get('client-edit/{id}', [ClientsController::class, 'edit']);
    Route::post('update-client', [ClientsController::class, 'update']);
    Route::get('/add-client-button', function () {
        return view('admin/setting/clients/button');
    });
//percent category setting
    Route::get('percent-category_setting', [PercentCategoryController::class, 'index']);
    Route::get('percent-category_datatable', [PercentCategoryController::class, 'datatable'])->name('percentcategry.datatable.data');
    Route::get('delete-percent-category', [PercentCategoryController::class, 'destroy']);
    Route::post('store-percent-category', [PercentCategoryController::class, 'store']);
    Route::get('edit-percent-category/{id}', [PercentCategoryController::class, 'edit']);
    Route::post('update-percent-category', [PercentCategoryController::class, 'update']);
    Route::get('/add-percent-category-button', function () {
        return view('admin/setting/PercentCategory/button');
    });
    Route::get('contract_setting', [ContractTypesController::class, 'index']);
    Route::get('contract_datatable', [ContractTypesController::class, 'datatable'])->name('contract.datatable.data');
    Route::get('delete-contract', [ContractTypesController::class, 'destroy']);
    Route::post('store-contract', [ContractTypesController::class, 'store']);
    Route::get('edit-contract/{id}', [ContractTypesController::class, 'edit']);
    Route::post('update-contract', [ContractTypesController::class, 'update']);
    Route::get('/add-contract-button', function () {
        return view('admin/setting/ContractCategory/button');
    });
//Messaging
    Route::get('messages', [MessagesController::class, 'index']);
    Route::get('messages_datatable', [MessagesController::class, 'datatable'])->name('messages.datatable.data');

//percent setting
    Route::get('percent-setting/{id}', [PercentController::class, 'index']);
    Route::get('percent-datatable', [PercentController::class, 'datatable'])->name('Percent.datatable.data');
    Route::get('delete-percent', [PercentController::class, 'destroy']);
    Route::post('store-percent', [PercentController::class, 'store']);
    Route::get('edit-percent/{id}', [PercentController::class, 'edit']);
    Route::post('update-percent', [PercentController::class, 'update']);
    Route::get('add-percent-button/{id}', [PercentController::class, 'button']);

});
