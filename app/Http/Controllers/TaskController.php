<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the incomplete tasks.
     */
    public function index()
    {
        $tasks = Task::where('is_completed', false)
            ->latest()
            ->take(5)
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created task in storage.
     */
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

    /**
     * Mark the specified task as done (deletes it for now).
     */
    public function markDone($id)
    {
        $task = Task::findOrFail($id);
        $task->delete(); // Consider changing this to mark as completed instead

        return response()->json([
            'message' => 'Task marked as done'
        ], 200);
    }
}
