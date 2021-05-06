<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    if (Auth::check()){
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('home', [
            'tasks' => $tasks
        ]);
    }else{
        return view('auth.login');
    }
    
});

Route::get('/task_new', function () {
    if (Auth::check()){
        return view('task_new');
    }else{
        return view('auth.login');
    }
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->short_desc = $request->short_desc;
    $task->deadline = $request->deadline;
    $task->description = $request->description;
    $task->user_id = 0;
    $task->save();

    return redirect('/');
});