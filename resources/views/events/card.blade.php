<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ивент') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">    
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($event->eventImage)
                        <img
                            class="event-page__img"
                            alt="{{ $event->eventImage->image_alt }}"
                            src="{{ asset('storage/images/'.$event->eventImage->image_name) }}"
                        >
                    @endif
                
                    <h1 class="event-page__title">{{ $event->title }}</h1>
                    <p class="event-page__description">{{ $event->description }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>