@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($tasks) > 0)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped task-table">

                                    <!-- Table Headings -->
                                    <thead>
                                        <th>Task</th>
                                        <th>&nbsp;</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="table-text">
                                                    <div>{{ $task->name }}</div>
                                                </td>

                                                @if (Auth::user()->privilege == 1)
                                                    <td>
                                                        <form action="/task/{{ $task->id }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                
                                                            <button>Zbriši</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
