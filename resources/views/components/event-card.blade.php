{{-- event card --}}
<a href="/event/{{ $event->id }}">
    <div class="event-card" style="background-color: {{ $event->background_colour }}">
        @if ($event->eventImage)
            <img
                class="event-card__img"
                alt="{{ $event->eventImage->image_alt }}"
                src="{{ asset('storage/images/'.$event->eventImage->image_name) }}"
            >
        @else
            <img src="{{ asset('default-image-path') }}" alt="Default Image" class="event-card__img">
        @endif
        <div class="event-card__bottom-part">
            <p>{{ $event->title }}</p>
        </div>
        <svg></svg>
    </div>
</a>