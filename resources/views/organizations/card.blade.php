<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ивент') }}
        </h2>
    </x-slot>

    @if ($event->eventImage)
        <img class="event-page__img" alt="{{ $event->eventImage->image_alt }}" src="{{ asset('storage/images/'.$event->eventImage->image_name) }}">
    @endif

    <h1 class="event-page__title">{{ $event->title }}</h1>
    <p class="event-page__description">{{ $event->description }}</p>
</x-app-layout>