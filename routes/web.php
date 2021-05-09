<?php

use App\Model\User;

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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [TaskController::class, 'show']);

    Route::get('/task', [TaskController::class, 'show']);
    Route::get('/task/new', [TaskController::class, 'new']);
    Route::get('/task/{id}/edit', [TaskController::class, 'edit']);
    Route::post('/task/{id}/update', [TaskController::class, 'update']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{id}', [TaskController::class, 'delete']);
    Route::get('/task/{id}/view', [TaskController::class, 'view']);
    
    Route::get('/status/{id}/edit', [StatusController::class, 'edit']);
    Route::post('/status/{id}/update', [StatusController::class, 'update']);
    Route::get('/status', [StatusController::class, 'show']);
    Route::get('/status/new', [StatusController::class, 'new']);
    Route::post('/status', [StatusController::class, 'store']);
    Route::delete('/status/{id}', [StatusController::class, 'delete']);

});