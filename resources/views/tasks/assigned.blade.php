@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Task Atamaları
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Hafta</th>
                                <th>Developer</th>
                                <th>Task</th>
                                <th>Zorluk</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($assignments as $assignment)
                                <tr>
                                    <td>{{ $assignment->week }}</td>
                                    <td>{{ $assignment->developer->name }}</td>
                                    <td>{{ $assignment->task->name }}</td>
                                    <td>{{ $assignment->task->difficulty }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
