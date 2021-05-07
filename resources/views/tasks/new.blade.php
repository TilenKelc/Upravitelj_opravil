
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @include('common.errors')

                    <form action="/task" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="task" class="col-sm control-label">Naziv opravila</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Kratek opis</label>

                            <div class="col-sm">
                                <input type="text" name="short_desc" id="short-desc" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Rok do:</label>

                            <div class="col-sm-6">
                                <input type="date" name="deadline" id="deadline" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="task" class="col-sm control-label">Dodeli uporabnika</label>
                            
                            <div class="col-sm" aria-labelledby="navbarDropdown">
                                <select id="user" name="user" class="col-sm form-control" required>
                                    <option value="none" selected disabled>Izberi</option>
                                    @foreach ($users as $user)
                                        
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Opis</label>

                            <div class="col-sm">
                                <textarea name="description" id="description" data-autoresize class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="col-sm-offset-3 col-sm">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Dodaj na seznam
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