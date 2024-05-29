<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event') }}
        </h2>
    </x-slot>

    <div class="events-list-container">
        @foreach ($events as $event)

            {{-- EVENT CARD --}}
                <a href="/event/{{ $event->id }}">
                    <img src="" alt="THIS IS IMAGE IMAGINE THIS BRO" class="event-card__img">
                    <div class="event-cont__bottom-part">
                        <p>{{ $event->title }}</p>
                    </div>
                    <svg></svg>
                </a>
            </div>

        @endforeach
    </div>
</x-app-layout>
