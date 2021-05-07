
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @include('common.errors')

                    <form action="/status" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="task" class="col-sm control-label">Ime statusa</label>

                            <div class="col-sm">
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="col-sm-offset-3 col-sm">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Dodaj nov status
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