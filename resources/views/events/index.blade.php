<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">    
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="events-list-container">
                        @foreach ($events as $event)

                            {{-- EVENT CARD --}}
                            <a href="/event/{{ $event->id }}">
                            <div class="event-card" style="background-color: {{ $event->background_colour }}">
                                    @if ($event->eventImage)
                                        <img src="{{ asset('storage/images/'.$event->eventImage->image_name) }}" alt="{{ $event->eventImage->image_alt }}" class="event-card__img">
                                    @else
                                        <img src="{{ asset('default-image-path') }}" alt="Default Image" class="event-card__img">
                                    @endif
                                    <div class="event-card__bottom-part">
                                        <p>{{ $event->title }}</p>
                                    </div>
                                    <svg></svg>
                                </div>
                            </a>
                            
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
