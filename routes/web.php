<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
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
Route::get('/', 'TaskController@in')->name('tasks.in');
       // Route::get('/', '@in'])->name('home');

// Route::group(['middleware' => 'auth'], function() {
//
//
//       Route::get('/folders/create', [FolderController::class, 'showCreateForm'])->name('folders.create');
//       Route::post('/folders/create', [FolderController::class, 'create']);
//
//       // Route::get('/login', 'App\Http\Controllers\Auth\LoginController@login');
//       // Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
//
//
//     Route::group(['middleware' => 'can:view,folder'], function() {
//
//       Route::get('/folders/{folder}/tasks/create', [TaskController::class, 'showCreateForm'])->name('tasks.create');
//       Route::post('/folders/{folder}/tasks/create', [TaskController::class, 'create']);
//
//       Route::get('/folders/{folder}/tasks/{task}/edit',[TaskController::class, 'showEditForm'])->name('tasks.edit');
//       Route::post('/folders/{folder}/tasks/{task}/edit',[TaskController::class, 'edit']);
//     });
// });
//
// Auth::routes();
