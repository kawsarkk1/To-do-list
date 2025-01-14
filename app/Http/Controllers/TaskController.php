<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Task::create([
            'title' => $request->title,
        ]);

        return redirect('/');
    }

    // Update a task (mark as completed or update title)
    public function update(Request $request, Task $task)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'completed' => 'required|boolean', // Ensure it's a boolean (true/false)
        ]);

        // Update the task with the validated fields
        $task->update($request->only(['title', 'completed']));

        return redirect('/');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/');
    }
}
