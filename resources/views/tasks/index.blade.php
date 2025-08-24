@extends('layouts.todo')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-50">

    {{-- Centered container --}}
    {{-- Background container --}}
    <div class="bg-gray-100 bg-opacity-50 shadow-xl rounded-3xl p-8 max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Task Form --}}
        <div class="bg-gray-50 p-6 rounded-2xl shadow-inner">
            <h2 class="text-xl font-semibold mb-4">Add New Task</h2>
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="title" placeholder="Task title"
                           class="w-full border p-2 rounded-lg" required>
                </div>
                <div class="mb-3">
                    <textarea name="description" placeholder="Task description (optional)"
                              class="w-full border p-2 rounded-lg"></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Add Task
                </button>
            </form>
        </div>

        {{-- Task List --}}
        <div class="bg-gray-50 p-6 rounded-2xl shadow-inner">
            <h2 class="text-xl font-semibold mb-4">Latest Tasks</h2>
            <div class="space-y-4" id="task-list">
                @forelse($tasks as $task)
                   <div class="bg-white p-4 rounded-2xl shadow flex justify-between items-center" id="task-{{ $task->id }}">
    <div>
        <h3 class="font-medium">{{ $task->title }}</h3>
        <p class="text-sm text-gray-600">{{ $task->description }}</p>
    </div>

    <!-- Circular Done Button with Check -->
    <label class="cursor-pointer">
        <input type="checkbox" onclick="markDone({{ $task->id }})" class="peer sr-only">
        <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-green-600 transition peer-checked:bg-green-600 peer-checked:border-green-600">
            <!-- Check mark -->
            <svg class="w-4 h-4 text-white hidden peer-checked:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </span>
    </label>
</div>


                @empty
                    <p class="text-gray-500">No tasks available.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

{{-- Simple JS for marking done --}}
<script>
async function markDone(id) {
    const response = await fetch(`/tasks/${id}/done`, {
        method: "PUT",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    });

    if (response.ok) {
        document.getElementById(`task-${id}`).remove();
    }
}
</script>
@endsection
