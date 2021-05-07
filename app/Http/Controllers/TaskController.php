<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Validator;


class TaskController extends Controller
{
    public function show()
    {
        if (Auth::check()){
            if (Auth::user()->privilege == 1){
                $tasks = Task::orderBy('created_at', 'asc')->get();
                return view('tasks.show', [
                    'tasks' => $tasks
                ]);
            }else{
                $tasks = Task::where('user_id', '=', Auth::user()->id)->get();
                return view('tasks.show', [
                    'tasks' => $tasks
                ]);
            }
        }else{
            return view('auth.login');
        }
    }

    public function new()
    {
        if (Auth::check()){
            $users = User::where('id', '!=', auth()->id())->get();
            return view('tasks.new', [
                'users' => $users
            ]);
        }else{
            return view('auth.login');
        }
    }

    public function store(Request $request)
    {
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
        $task->user_id = $request->user;
        $task->save();
    
        return redirect('/');
    }
}
