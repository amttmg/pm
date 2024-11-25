<?php

use Livewire\Volt\Component;
use App\Models\Project;

new class extends Component {
    public $project;
    public $columns;

    /**
     * Delete the currently authenticated user.
     */
    public function mount($id)
    {
        $this->project = Project::with('descriptions')->find($id);
        // $this->project = [
        //     'name' => 'Project Name',
        //     'description' => 'This is a sample project description.',
        //     'manager' => 'John Doe',
        //     'deadline' => '2024-12-31',
        //     'status' => 'In Progress',
        // ];

        $this->columns = [
            'To Do' => [['title' => 'Task 1', 'description' => 'This is the first task.'], ['title' => 'Task 2', 'description' => 'This is the second task.']],
            'Working' => [['title' => 'Task 3', 'description' => 'This task is in progress.']],
            'Testing' => [],
            'Complete' => [['title' => 'Task 4', 'description' => 'This task is complete.']],
        ];
    }
}; ?>

<div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">

    <!-- resources/views/livewire/kanban-board.blade.php -->
    <div class="flex h-screen">
        <!-- Left Sidebar -->
        <div class="w-1/4 p-4 bg-gray-100 border-r border-gray-200">
            <h2 class="mb-4 text-xl font-bold">{{ $project->title }}</h2>
            <p class="mb-6 text-sm text-gray-600">{{ $project->description }}</p>
            @foreach ($project->descriptions as $desc)
                <div>
                    <h3 class="mb-2 text-lg font-semibold">{{ $desc->title }}</h3>
                    <p class="mb-6 text-sm text-gray-600">{{ $desc->description }}</p>
                </div>
            @endforeach
        </div>

        <!-- Kanban Board -->
        <div class="grid flex-1 grid-cols-4 gap-4 p-4 bg-gray-50">
            @foreach ($columns as $status => $tasks)
                <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="px-4 py-2 text-lg font-bold text-gray-700 border-b bg-gray-50">
                        {{ $status }}
                    </div>
                    <div class="p-4 space-y-2 h-[calc(100vh-64px)] overflow-auto">
                        @foreach ($tasks as $task)
                            <div class="p-3 text-gray-800 bg-blue-100 rounded-md shadow hover:shadow-md">
                                <h4 class="font-semibold">{{ $task['title'] }}</h4>
                                <p class="text-sm">{{ $task['description'] }}</p>
                            </div>
                        @endforeach
                        @if (empty($tasks))
                            <p class="italic text-center text-gray-500">No tasks</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</div>
