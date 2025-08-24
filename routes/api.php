<?php
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index']);     // Get latest 5 tasks
Route::post('/tasks', [TaskController::class, 'store']);    // Create new task
Route::put('/tasks/{id}/done', [TaskController::class, 'markDone']); // Mark as done

