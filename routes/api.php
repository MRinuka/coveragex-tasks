<?php
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index']);     
Route::post('/tasks', [TaskController::class, 'store']);    
Route::put('/tasks/{id}/done', [TaskController::class, 'markDone']); 

