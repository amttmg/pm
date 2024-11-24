<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:projects.project-list></livewire:projects.project-list>
    </div>
</x-app-layout>
