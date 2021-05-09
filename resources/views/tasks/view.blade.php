
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @include('common.errors')
                    
                    <div class="form-group row ml-0 mr-0">
                        <label for="task" class="col-sm control-label">Naziv opravila:</label>
                        <label for="task" class="col-sm control-label">{{ $task->name }}</label>
                    </div>
                    <div class="form-group row ml-0 mr-0">
                        <label for="task" class="col-sm control-label">Kratek opis:</label>
                        <label for="task" class="col-sm control-label">{{ $task->short_desc }}</label>
                    </div>
                    <div class="form-group row ml-0 mr-0">
                        <label for="task" class="col-sm control-label">Dodeljeni uporabnik:</label>
                        <label for="task" class="col-sm control-label">{{ $user->name }}</label>
                    </div>
                    <div class="form-group row ml-0 mr-0">
                        <label for="task" class="col-sm control-label">Rok:</label>
                        <label for="task" class="col-sm control-label">{{ $task->deadline }}</label>
                    </div>
                    <div class="form-group row ml-0 mr-0">
                        <label for="task" class="col-sm control-label">Status:</label>
                        <label for="task" class="col-sm control-label">{{ $status }}</label>
                    </div>
                    <div class="form-group row ml-0 mr-0">
                        <label for="task" class="col-sm control-label">Opis:</label>
                        <label for="task" class="col-sm control-label">{{ $task->description }}</label>
                    </div>
                        


                    <div class="form-group text-center">
                        <div class="col-sm-offset-3 col-sm">
                            <a href="/" class="btn btn-primary">
                                Nazaj
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection