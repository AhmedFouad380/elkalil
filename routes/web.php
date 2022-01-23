<?php

use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ContractTypesController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\LevelDetailsController;
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
Route::get('/login', function () {
    return view('auth/login');
})->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('/forget-password', function () {
    return view('auth/forget_password');
});
Route::post('forgetPassword', [AuthController::class, 'forgetPassword']);
Route::post('checkCode', [AuthController::class, 'checkCode']);
Route::post('updatePassword', [AuthController::class, 'updatePassword']);


Route::get('/quest', function () {
    return view('auth/request');
});

Route::get('/quest', function () {
    return view('auth/request');
});
Route::post('/quest', 'App\Http\Controllers\Front\PageController@store_quest')->name('create_quest.submit');

Route::get('logout', [AuthController::class, 'logout']);

Route::get('/table', function () {
    return view('admin/table');
});

Route::get('/projects', function () {
    return view('admin/projects');
});
Route::group(['middleware' => ['admin']], function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/home', [DashboardController::class, 'index']);
    Route::get('public_setting', [SettingsController::class, 'Settings']);
    Route::post('edit_setting', [SettingsController::class, 'editSettings']);

    Route::post('/store_event', [\App\Http\Controllers\DashboardController::class, 'store_event']);
    Route::get('/projectState', [\App\Http\Controllers\DashboardController::class, 'projectState']);

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
//Level setting
    Route::get('level-setting/{id}', [LevelController::class, 'index']);
    Route::get('level-datatable', [LevelController::class, 'datatable'])->name('Level.datatable.data');
    Route::get('delete-level', [LevelController::class, 'destroy']);
    Route::post('store-level', [LevelController::class, 'store']);
    Route::get('edit-level/{id}', [LevelController::class, 'edit']);
    Route::post('update-level', [LevelController::class, 'update']);
    Route::get('add-level-button/{id}', [LevelController::class, 'button']);


//Level details setting
    Route::get('level-details-setting/{id}', [LevelDetailsController::class, 'index']);
    Route::get('level-details-datatable', [LevelDetailsController::class, 'datatable'])->name('Level.details.datatable.data');
    Route::get('delete-details-level', [LevelDetailsController::class, 'destroy']);
    Route::post('store-details-level', [LevelDetailsController::class, 'store']);
    Route::get('edit-details-level/{id}', [LevelDetailsController::class, 'edit']);
    Route::post('update-details-level', [LevelDetailsController::class, 'update']);
    Route::get('add-level-details-button/{id}', [LevelDetailsController::class, 'button']);
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
//Requests settings
    Route::get('Requests', [\App\Http\Controllers\Admin\RequestsController::class, 'index']);
    Route::get('Requests_datatable', [\App\Http\Controllers\Admin\RequestsController::class, 'datatable'])->name('Requests.datatable.data');
    Route::post('updateLocation', [\App\Http\Controllers\Admin\RequestsController::class, 'updateLocation'])->name('updateLocation');
    Route::post('updateProjectData', [\App\Http\Controllers\Admin\RequestsController::class, 'updateProjectData'])->name('updateProjectData');
    Route::get('RejectProject', [\App\Http\Controllers\Admin\RequestsController::class, 'RejectProject'])->name('RejectProject');
    Route::get('AcceptProject', [\App\Http\Controllers\Admin\RequestsController::class, 'AcceptProject'])->name('AcceptProject');
    Route::get('Requests-edit/{id}', [\App\Http\Controllers\Admin\RequestsController::class, 'edit']);
    // Projects
    Route::get('projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index']);
    Route::get('projectFiles/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'projectFiles']);
    Route::get('projectExplan/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'projectExplan']);
    Route::get('projectEmployes/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'projectEmployes']);
    Route::get('assign_users/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'assign_users']);
    Route::post('assgin_new_user', [\App\Http\Controllers\Admin\ProjectController::class, 'assgin_new_user']);
    Route::get('remove_assign_user', [\App\Http\Controllers\Admin\ProjectController::class, 'remove_assign_user']);
    Route::get('DeleteProject', [\App\Http\Controllers\Admin\ProjectController::class, 'DeleteProject']);

    Route::post('store-new-level', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'store_level']);
    Route::post('store-new-levelDetail', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'store_new_levelDetail']);
    Route::get('CompleteLevel', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'CompleteLevel']);
    Route::get('edit-LevelDetails', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'edit_LevelDetails']);
    Route::post('AnswerLevelDetails', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'AnswerLevelDetails']);
    Route::post('Store_ProgressTime', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'Store_ProgressTime']);
    Route::get('changeState', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'changeState']);
    Route::get('Chat-level/{id}', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'ChatLevel']);
    Route::get('StoreChat', [\App\Http\Controllers\Admin\ProjectLevelController::class, 'StoreChat']);

    Route::post('store-project', [\App\Http\Controllers\Admin\ProjectController::class, 'store']);
    Route::get('project_details/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'project_details']);
    Route::get('level_Details/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'level_Details']);

    Route::get('Contracts', [\App\Http\Controllers\Admin\ContractsController::class, 'index']);
    Route::get('Contracts_datatable', [\App\Http\Controllers\Admin\ContractsController::class, 'datatable'])->name('Contracts.datatable.data');
    Route::get('ConfirmProject', [\App\Http\Controllers\Admin\ContractsController::class, 'ConfirmProject'])->name('ConfirmProject');
    Route::get('Contracts-edit/{id}', [\App\Http\Controllers\Admin\ContractsController::class, 'edit']);
    Route::post('UpdateProjectContract', [\App\Http\Controllers\Admin\ContractsController::class, 'UpdateProjectContract'])->name('UpdateProjectContract');
    Route::post('UpdateProjectPaid', [\App\Http\Controllers\Admin\ContractsController::class, 'UpdateProjectPaid'])->name('UpdateProjectContract');
    Route::post('Send_revision', [\App\Http\Controllers\Admin\ContractsController::class, 'Send_revision'])->name('Send_revision');
    Route::post('Send_paid', [\App\Http\Controllers\Admin\ContractsController::class, 'Send_paid'])->name('Send_paid');
    Route::post('Send_price', [\App\Http\Controllers\Admin\ContractsController::class, 'Send_price'])->name('Send_price');
    Route::post('Send_template', [\App\Http\Controllers\Admin\ContractsController::class, 'Send_template'])->name('Send_template');
    Route::post('Send_quest', [\App\Http\Controllers\Admin\ContractsController::class, 'Send_quest'])->name('Send_quest');
    Route::post('UpdateClientData', [\App\Http\Controllers\Admin\ContractsController::class, 'UpdateClientData'])->name('UpdateClientData');

    Route::get('/add-Requests-button', function () {
        return view('admin/Requests/button');
    });

    // Explan

    Route::post('Add_explan', [\App\Http\Controllers\Admin\ExplanController::class, 'Add_explan'])->name('Add_explan');


    Route::get('inbox', [InboxController::class, 'index'])->name('inbox');
    Route::get('reply/{id}', [InboxController::class, 'show'])->name('reply');


    Route::get('Get_Levels', [PageController::class, 'Get_Levels']);
    Route::get('contractName', [PageController::class, 'contractName']);
    Route::get('getMoney', [PageController::class, 'getMoney']);


    Route::get('/quest2/{client_id}/{emp_id?}', [PageController::class, 'quest2']);
    Route::post('/quest2', 'App\Http\Controllers\Front\PageController@store_quest2')->name('create_quest2.submit');
    Route::get('success_msg', [PageController::class, 'success_msg']);


    Route::get('/table', function () {
        return view('admin/table');
    });

    Route::get('/table-view', function () {
        return view('admin/table-view');
    });

//Route::get('/project-details/{id}', function () {
//    return view('admin/project_details');
//});

    Route::get('/project-details2', function () {
        return view('admin/project_details2');
    });

    Route::get('/project-details3', function () {
        return view('admin/project_details3');
    });

    Route::get('/project-details4', function () {
        return view('admin/project_details4');
    });

    Route::get('/project-details5', function () {
        return view('admin/project_details5');
    });

    Route::get('/project-details6', function () {
        return view('admin/project_details6');
    });

    Route::get('/project-details7', function () {
        return view('admin/project_details7');
    });
    Route::get('/project-details8', function () {
        return view('admin/project_details8');
    });


    Route::get('/project_details2', function () {
        return view('admin/project_details2');
    });
    Route::get('/project_details3', function () {
        return view('admin/project_details3');
    });
    Route::get('/project_details4', function () {
        return view('admin/project_details4');
    });
    Route::get('/project_details5', function () {
        return view('admin/project_details5');
    });
    Route::get('/project_details6', function () {
        return view('admin/project_details6');
    });
    Route::get('/project_details7', function () {
        return view('admin/project_details7');
    });

    Route::get('/project_details8', function () {
        return view('admin/project_details8');
    });

    Route::get('GetLevelDetails/{id}', ['App\Http\Controllers\Admin\ProjectLevelController', 'GetLevelDetails']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('project-archive', [ArchiveController::class, 'index']);
    Route::get('archive_datatable', [ArchiveController::class, 'datatable'])->name('archive.datatable.data');

    Route::get('/archive-button', function () {
        return view('admin/reports/archive/button');
    });
});

Route::post('login', [AuthController::class, 'login']);
Route::get('success_msg', [PageController::class, 'success_msg']);
