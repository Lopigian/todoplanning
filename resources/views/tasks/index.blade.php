@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task List</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Provider</th>
                <th>Task Name</th>
                <th>Duration (hours)</th>
                <th>Difficulty</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->provider->name }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->duration }}</td>
                    <td>{{ $task->difficulty }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
