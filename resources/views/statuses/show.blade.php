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

                    @if (count($statuses) > 0)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped task-table">

                                    <!-- Table Headings -->
                                    <thead>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($statuses as $status)
                                            <tr>
                                                <td class="table-text">
                                                    <div>{{ $status->name }}</div>
                                                </td>

                                                @if (Auth::user()->privilege == 1)
                                                    <td>
                                                        <form action="/status/{{ $status->id }}/edit" class="text-center">                                                
                                                            <button>Posodobi</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="/status/{{ $status->id }}" method="POST" class="text-center">
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
                    @else
                        <div class="panel panel-default">
                            Ni dodanih statusov
                        </div>
                    @endif
                    <div class="panel panel-default">
                        <form action="/status/new" method="GET" class="text-center">                        
                            <button>Dodaj nov status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
