<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event') }}
        </h2>
    </x-slot>

    <div class="events-list-container">
        @foreach ($events as $event)

            {{-- EVENT CARD --}}
            <div class="event-card">
                <a href="/event/{{ $event->id }}">
                    @if ($event->eventImage)
                        <img src="{{ asset('storage/images/'.$event->eventImage->image_name) }}" alt="{{ $event->eventImage->image_alt }}" class="event-card__img">
                    @else
                        <img src="{{ asset('default-image-path') }}" alt="Default Image" class="event-card__img">
                    @endif
                    <div class="event-card__bottom-part">
                        <p>{{ $event->title }}</p>
                    </div>
                    <svg></svg>
                </a>
            </div>

        @endforeach
    </div>
</x-app-layout>
