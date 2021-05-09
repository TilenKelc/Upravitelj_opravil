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
        if (Auth::user()->privilege == 1){
            $statuses = Status::orderBy('created_at', 'asc')->get();
            return view('statuses.show', [
                'statuses' => $statuses
            ]);
        }else{
            return redirect('/');
        }
    }

    public function new()
    {
        if (Auth::user()->privilege == 1){
            return view('statuses.new');
        }else{
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->privilege == 1){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
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
        }else{
            return redirect('/');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->privilege == 1){
            Status::findOrFail($id)->delete();
            return redirect('status');
        }else{
            return redirect('/');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->privilege == 1){
            $status = Status::find($id);
            return view('statuses.edit', [
                'status' => $status
            ]);
        }else{
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->privilege == 1){
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
        }else{
            return redirect('/');
        }
    }
}
