<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $tasks = $user->tasks()->with('project')->orderBy('priority', 'asc')->get();

        return Inertia::render('Task/Index', [
            'tasks' => $tasks,
            'status' => session('status'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $projects = $user->projects;

        return Inertia::render('Task/Create', [
            'projects' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->only('name', 'priority', 'project_id');
        $task = Task::create(array_merge(['user_id' => auth()->user()->id], $data));

        return redirect()->route('task.index')->with('status', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('projects');

        return Inertia::render('Task/Show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $user = Auth::user();

        $projects = $user->projects;

        return Inertia::render('Task/Edit', [
            'task' => $task->load('project'),
            'projects' => $projects,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->only('name', 'priority', 'project_id'));

        return redirect()->route('task.index')->with('status', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index')->with('status', 'Task deleted successfully.');
    }
}
