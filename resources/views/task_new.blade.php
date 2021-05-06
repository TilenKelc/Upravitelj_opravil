
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
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Kratek opis</label>

                            <div class="col-sm">
                                <input type="text" name="short_desc" id="short-desc" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Rok do:</label>

                            <div class="col-sm-6">
                                <input type="date" name="deadline" id="deadline" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Opis</label>

                            <div class="col-sm">
                                <textarea name="description" id="description" data-autoresize class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
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