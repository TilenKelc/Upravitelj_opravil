<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Status;
use Validator;

class StatusController extends Controller
{
    public function show()
    {
        if (Auth::check()){
            if (Auth::user()->privilege == 1){
                $statuses = Status::orderBy('created_at', 'asc')->get();
                return view('statuses.show', [
                    'statuses' => $statuses
                ]);
            }else{
                return redirect('home');
            }
        }else{
            return view('auth.login');
        }
    }

    public function new()
    {
        if (Auth::check()){
            if (Auth::user()->privilege == 1){
                return view('statuses.new');
            }else{
                return redirect('home');
            }
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
    
        $status = new Status;
        $status->name = $request->name;
        $status->save();
    
        return redirect('status');
    }

    public function delete($id)
    {
        Status::findOrFail($id)->delete();
        return redirect('status');
    }

    public function edit($id)
    {
        if (Auth::check()){
            if (Auth::user()->privilege == 1){
                $status = Status::find($id);
                return view('statuses.edit', [
                    'status' => $status
                ]);
            }else{
                return redirect('/');
            }
        }else{
            return view('auth.login');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
    
        $status = Status::find($id);
        $status->name = $request->name;
        $status->save();
    
        return redirect('status');
    }
}
