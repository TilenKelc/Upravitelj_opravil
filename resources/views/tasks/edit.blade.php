
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @include('common.errors')

                    <form action="/task/{{ $task->id }}/update" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        @if (Auth::user()->privilege == 1)
                            <div class="form-group">
                                <label for="task" class="col-sm control-label">Naziv opravila</label>

                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name" class="form-control" required value="{{ $task->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="task" class="col-sm control-label">Kratek opis</label>

                                <div class="col-sm">
                                    <input type="text" name="short_desc" id="short-desc" class="form-control" required value="{{ $task->short_desc }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Rok do:</label>

                                <div class="col-sm-6">
                                    <input type="date" name="deadline" id="deadline" class="form-control" required value="{{ $task->deadline }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="task" class="col-sm control-label">Dodeli uporabnika</label>
                                <div class="col-sm" aria-labelledby="navbarDropdown">
                                    <select id="user" name="user" class="col-sm form-control" required>
                                        <option value="none" disabled>Izberi</option>
                                        @foreach ($users as $user)
                                            @if ($current_user->id == $user->id)
                                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Opis</label>

                                <div class="col-sm">
                                    <textarea name="description" id="description" data-autoresize class="form-control" required>{{ $task->description }}</textarea>
                                </div>
                            </div>    
                        @else
                            <div class="form-group">
                                <label for="task" class="col-sm control-label">Dodeli status</label>
                                <div class="col-sm" aria-labelledby="navbarDropdown">
                                    <select id="status" name="status" class="col-sm form-control" required>
                                        @if (empty($current_status))
                                            <option value="none" disabled selected>Izberi</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="none" disabled>Izberi</option>
                                            @foreach ($statuses as $status)
                                                @if ($current_status->id == $status->id)
                                                    <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                                                @else
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group text-center">
                            <div class="col-sm-offset-3 col-sm">
                                <button type="submit" class="btn btn-primary">
                                    Posodobi
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection