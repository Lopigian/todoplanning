<?php

namespace App\Http\Controllers;

use App\Business\Services\TaskAssignmentService;
use App\Models\Developer;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }


    public function showAssignments()
    {
        $developers = Developer::all();
        $tasks = (new TaskAssignmentService())->getPlan($developers->toArray());
        return view('tasks.list', compact('tasks'));
    }
}
