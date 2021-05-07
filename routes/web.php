<?php

use App\Models\Task;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;

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

Auth::routes();

Route::get('/', [TaskController::class, 'show']);
Route::get('/task_new', [TaskController::class, 'new']);
Route::post('/task', [TaskController::class, 'store']);


Route::get('/status/{id}/edit', [StatusController::class, 'edit']);
Route::post('/status/{id}/update', [StatusController::class, 'update']);
Route::get('/status', [StatusController::class, 'show']);
Route::get('/status/new', [StatusController::class, 'new']);
Route::post('/status', [StatusController::class, 'store']);
Route::delete('/status/{id}', [StatusController::class, 'delete']);




