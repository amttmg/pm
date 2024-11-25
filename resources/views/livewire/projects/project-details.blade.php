<?php

use Livewire\Volt\Component;
use App\Models\Project;

new class extends Component {
    public $project;
    public $columns;
    public $showModal = false; // Tracks modal visibility
    public $newDetails = [
        'title' => '',
        'description' => '',
    ];

    /**
     * Delete the currently authenticated user.
     */
    public function mount($id)
    {
        $this->project = Project::with(['descriptions', 'files'])->find($id);

        $this->columns = [
            'To Do' => [['title' => 'Task 1', 'description' => 'This is the first task.'], ['title' => 'Task 2', 'description' => 'This is the second task.']],
            'Working' => [['title' => 'Task 3', 'description' => 'This task is in progress.']],
            'Testing' => [],
            'Complete' => [['title' => 'Task 4', 'description' => 'This task is complete.']],
        ];
    }

    public function addDetails()
    {
        // Validate the data
        $this->validate([
            'newDetails.title' => 'required|string|max:255',
            'newDetails.description' => 'required|string|max:1000',
        ]);

        $this->project->descriptions()->create($this->newDetails);
        $this->newDetails = [
            'title' => '',
            'description' => '',
        ];
        // Logic to add a new task (not fully implemented in the original code)
        $this->showModal = false; // Close modal after task is added
    }
};
?>

<div x-data="{ showModal: @entangle('showModal') }" class="mx-auto max-w-7xl sm:px-6 lg:px-8">

    <!-- Main Container -->
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

            <!-- Add Task Button -->
            <button class="w-full px-4 py-2 mt-6 text-white bg-blue-500 rounded hover:bg-blue-600"
                @click="showModal = true">
                + Add Details
            </button>
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

    <!-- Modal Add details of projects-->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;">
        <div class="w-1/3 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between px-4 py-3 bg-gray-100 border-b">
                <h3 class="text-lg font-semibold">Add New Details</h3>
                <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" wire:model="newDetails.title"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                    @error('newDetails.title')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="newDetails.description" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    @error('newDetails.description')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                </div>
                <div class="flex justify-end">
                    <button @click="showModal = false"
                        class="px-4 py-2 mr-2 text-gray-800 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button wire:click="addDetails" @click="showModal = false"
                        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Add Task</button>
                </div>
            </div>
        </div>
    </div>
</div>
