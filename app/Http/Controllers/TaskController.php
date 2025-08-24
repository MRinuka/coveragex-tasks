<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::where('is_completed', false)
            ->latest()
            ->take(5)
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    
    public function markDone($id)
    {
        $task = Task::findOrFail($id);
        $task->delete(); 

        return response()->json([
            'message' => 'Task marked as done'
        ], 200);
    }
}
