@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           @foreach($tasks as $developer)
           <div class="col-sm-6 p-2">
                   <div class="text-center">
                       <h4>{{ $developer['name'] }}</h4>
                       Level : {{ $developer['capacity'] }} - Total Duration : {{ $developer['duration'] }}h
                   </div>

                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>Task Name</th>
                               <th>Capacity</th>
                               <th>Duration</th>
                           </tr>
                       </thead>
                       @foreach($developer['weekly'] as $week => $daily)
                           <div class="col-sm">
                               <h5 class="text-dark">{{ ($week + 1) }}. Week</h5>

                               @foreach($daily['tasks'] as $task)
                                       <tr>
                                           <td>{{ $task['name'] }}</td>
                                           <td> {{ $task['capacity'] }}x</td>
                                           <td> {{ $task['duration'] }}h</td>
                                       </tr>
                               @endforeach
                           </div>
                       @endforeach
                   </table>

            </div>
            @endforeach

        </div>
    </div>
@endsection
