<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->tasks()->latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        return $request->user()->tasks()->create($data);
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'in:low,medium,high',
            'due_date' => 'nullable|date',
            'is_completed' => 'boolean',
        ]);

        $task->update($data);
        return $task;
    }

    public function destroy(Request $request, Task $task)
    {
        abort_if($task->user_id !== $request->user()->id, 403);
        $task->delete();
        return response()->noContent();
    }
}