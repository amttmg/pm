<?php

use Livewire\Volt\Component;
use App\Models\Project;

new class extends Component {
    public $projects = [];

    /**
     * Delete the currently authenticated user.
     */
    public function mount()
    {
        $this->projects = Project::with('descriptions')->get();
    }
}; ?>

<div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Main Box 1 -->
        @foreach ($projects as $project)
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">
                    <a href="{{ route('projects.details', $project->id) }}">{{ $project->title }}</a>
                </h2>
                <div class="space-y-4">
                    <div class="p-4 bg-blue-100 rounded-md">
                        <p class="text-sm text-blue-800">
                            {{ $project->description }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
