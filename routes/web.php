<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PMSController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SyncronizeController;
use App\Http\Controllers\TaskjobController;
use App\Http\Controllers\TaskjobGroupController;
use App\Http\Controllers\UserController;
use App\Models\InventoryStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('/', [LoginController::class, 'showLoginForm']);

Route::middleware('auth')->prefix('/admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/group', [GroupController::class, 'index'])->name('group');

    Route::get('/pull-data', [SyncronizeController::class, 'pull_data'])->name('pull-data');
    Route::get('/push-data', [SyncronizeController::class, 'push_data'])->name('push-data');

    //User Management
    Route::get('/user', [UserController::class, 'index'])->name('user-management');
    Route::get('/user-add', [UserController::class, 'create'])->name('user-add');
    Route::post('/user', [UserController::class, 'store'])->name('add-user');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('update-user');
    Route::get('/user/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete-user');

    //Role Management
    Route::get('/role', [RoleController::class, 'index'])->name('role-management');
    Route::get('/role-add', [RoleController::class, 'create'])->name('role-add');
    Route::post('/role', [RoleController::class, 'store'])->name('add-role');
    Route::get('/role/{id}', [RoleController::class, 'edit'])->name('edit-role');
    Route::put('/role/{id}', [RoleController::class, 'update'])->name('update-role');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('delete-role');

    //Create Data Group

    Route::post('/createGroup', [GroupController::class, 'create_group']);

    //Detail Data Gruop
    Route::get('/detail-group', [GroupController::class, 'detail']);
    Route::get('/detail-unit', [GroupController::class, 'detail_unit']);
    Route::get('/detail-component', [GroupController::class, 'detail_component']);
    Route::get('/detail-part', [GroupController::class, 'detail_part']);
    Route::get('/detail-sub-part/{id}', [GroupController::class, 'detail_sub_part']);
    Route::get('/detail-subpart', [GroupController::class, 'detail_subpart']);
    Route::get('/delete/{kode}', [GroupController::class, 'delete']);

    //Update Data Group
    Route::post('/updateUnit', [GroupController::class, 'update_unit']);
    Route::post('/updateComponent', [GroupController::class, 'update_component']);
    Route::post('/updatePart', [GroupController::class, 'update_part']);
    Route::post('/updateSubPart', [GroupController::class, 'update_sub_part']);
    Route::get('/group-name/{id}', [GroupController::class, 'group_name']);

    //TaskJob
    Route::get('/taskjob', [TaskjobController::class, 'index'])->name('taskjob');
    Route::post('/taskjob', [TaskjobController::class, 'store'])->name('add-taskjob');
    Route::get('/add-taskjob', [TaskjobController::class, 'create'])->name('taskjob-add');
    Route::get('/taskjob/{id}', [TaskjobController::class, 'edit'])->name('edit-taskjob');
    Route::put('/taskjob', [TaskjobController::class, 'update'])->name('update-taskjob');
    Route::delete('/taskjob/{id}', [TaskjobController::class, 'destroy'])->name('delete-taskjob');
    Route::post('/group-taskjob-add', [TaskjobGroupController::class, 'store'])->name('add-group-taskjob');
    Route::put('/group-taskjob-edit', [TaskjobGroupController::class, 'update'])->name('edit-group-taskjob');
    Route::delete('/group-taskjob-delete/{id}', [TaskjobGroupController::class, 'destroy'])->name('delete-group-taskjob');
    Route::post('/add-running-hour', [TaskjobController::class, 'running_hour'])->name('process-running-hour');
    Route::post('/add-running-hour-group', [TaskjobController::class, 'running_hour_group'])->name('process-running-hour-group');
    Route::patch('/give-role-taskjob', [TaskjobController::class, 'give_role'])->name('give-role-taskjob');
    Route::patch('/give-role-taskjob-group', [TaskjobController::class, 'give_role_group'])->name('give-role-taskjob-group');

    //PMS
    Route::get('/PMS', [PMSController::class, 'index'])->name('PMS');
    Route::patch('/PMS', [PMSController::class, 'open_pms'])->name('open-pms');
    Route::put('/PMS', [PMSController::class, 'assign_pms'])->name('assign-pms');
    Route::get('/preview-PMS', [PMSController::class, 'preview_pms'])->name('preview-pms');

    //Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::put('/add-group-inventory', [InventoryController::class, 'add_group'])->name('add-group-inventory');
    Route::patch('/edit-group-inventory', [InventoryController::class, 'edit_group'])->name('edit-group-inventory');
    Route::delete('/delete-group-inventory', [InventoryController::class, 'delete_group'])->name('delete-group-inventory');
    Route::patch('/assign-inventory', [InventoryController::class, 'assign_inventory'])->name('assign-inventory');
    Route::get('/list-item', [InventoryController::class, 'list_inventory'])->name('list-inventory');
    Route::put('/edit-inventory', [InventoryController::class, 'edit_inventory'])->name('edit-inventory');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
