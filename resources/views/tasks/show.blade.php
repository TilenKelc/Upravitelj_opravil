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
                                        <th>Opravilo</th>
                                        <th>Kratek opis</th>
                                        <th>Rok</th>
                                        <th>Urejanje</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="table-text">
                                                    <div>{{ $task->name }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $task->short_desc }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $task->deadline }}</div>
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-list"></i> <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="/task/{{ $task->id }}/view" class="dropdown-item">Ogled</a></li>

                                                            @if (Auth::user()->privilege == 1)
                                                                <li><a href="/task/{{ $task->id }}/edit" class="dropdown-item">Posodobi</a></li>
                                                                <li><form action="/task/{{ $task->id }}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button class="dropdown-item">Zbriši</button>
                                                                </form></li>
                                                            @else
                                                                <li><a href="/task/{{ $task->id }}/edit" class="dropdown-item">Spremeni status</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>                        
                    @else
                        <div class="panel panel-default">
                            Ni dodanih opravil
                        </div>
                    @endif
                    @if (Auth::user()->privilege == 1)
                        <div class="panel panel-default">
                            <form action="/task/new" method="GET" class="text-center">                        
                                <button class="btn btn-primary">Dodaj novo opravilo</button>
                            </form>
                        </div>                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
