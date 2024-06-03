<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ивенты') }}
        </h2>
    </x-slot>

    <div class="events-list-container">
        @foreach ($events as $event)
            <x-event-card :event="$event" />
        @endforeach
    </div>
</x-app-layout>
