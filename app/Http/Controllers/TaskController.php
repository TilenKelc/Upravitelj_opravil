<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use Validator;


class TaskController extends Controller
{
    public function show()
    {
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
    }

    public function new()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $statuses = Status::orderBy('created_at', 'asc')->get();
        return view('tasks.new', [
            'users' => $users,
            'statuses' => $statuses
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'short_desc' => 'required',
            'deadline' => 'required',
            'description' => 'required',
            'user' => 'required'
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

    public function delete($id)
    {
        Task::findOrFail($id)->delete();
        return redirect('/');
    }

    public function edit($id)
    {   
        $task = Task::find($id);
        $user = User::find($task->user_id);
        $users = User::where('id', '!=', auth()->id())->get();
        $statuses = Status::orderBy('created_at', 'asc')->get();
        $status = Status::find($task->status_id);

        return view('tasks.edit', [
            'task' => $task,
            'current_user' => $user,
            'users' => $users,
            'statuses' => $statuses,
            'current_status' => $status,
        ]);
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->privilege == 1){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'short_desc' => 'required',
                'deadline' => 'required',
                'description' => 'required',
                'user' => 'required',
                
            ]);
        
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
            }
        
            $task = Task::find($id);
            $task->name = $request->name;
            $task->short_desc = $request->short_desc;
            $task->deadline = $request->deadline;
            $task->description = $request->description;
            $task->status_id = $request->status;
            $task->user_id = $request->user;
            $task->save();
        
        }else{
            $validator = Validator::make($request->all(), [
                'status' => 'required'
            ]);
        
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
            }
        
            $task = Task::find($id);
            $task->status_id = $request->status;
            $task->save();
        
        }
       
        return redirect('/');
    }

    public function view($id)
    {
        $task = Task::find($id);
        if(empty($task->status_id)){
            $status = "Ni še dodeljenega statusa";
        }else{
            $status = Status::find($task->status_id)->name;
        }
        $user = User::find($task->user_id);

        return view('tasks.view', [
            'task' => $task,
            'user' => $user,
            'status' => $status
        ]);
    }
}
