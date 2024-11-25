<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:projects.project-details :id="$id"></livewire:projects.project-details>
    </div>
</x-app-layout>
