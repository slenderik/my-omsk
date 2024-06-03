<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Список организаций') }}
        </h2>
    </x-slot>

    <div class="events-list-container">
        @foreach ($organizations as $organization)
            <x-organizator-card :organization="$organization" />
        @endforeach
    </div>
</x-app-layout>
