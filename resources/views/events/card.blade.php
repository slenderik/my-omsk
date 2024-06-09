<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ивент') }}
        </h2>
    </x-slot>

    {{-- ADMIN MENU --}}
    @if (true)
        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-event-deletion')">{{ __('Удалить') }}</x-danger-button>
        <a href="{{ route('event.edit', ['id' => $event->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
            {{ __('Изменить') }}
        </a>
    @endif
    {{-- /ADMIN MENU --}}

    {{-- Image --}}
    @if ($event?->eventImage)
        <img
            class="event-page__img"
            alt="{{ $event->eventImage->image_alt }}"
            src="{{ asset('storage/images/'.$event->eventImage->image_name) }}"
        >
    @endif

    <h1 class="event-page__title">{{ $event->title }}</h1>
    <p class="event-page__description">{{ $event->description }}</p>

    {{-- Organization --}}
    @if ($event->organization)
        <x-organizator-card :organization="$event->organization" />
    @endif


    {{-- DELETE MODAl --}}
    @if (true)
        <x-modal name="confirm-event-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('api.event.delete', ['id' => $event->id]) }}" class="p-6">
                @csrf
                @method('delete')
        
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Удалить <strong>{{ $event->title }}</strong>?
                </h2>
        
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Если нужно скрыть - отправьте в архив.') }}
                </p>
        
                <div class="mt-6">
        
                    <x-text-input
                        id="event_name"
                        name="event_name"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Название ивента') }}"
                    />
        
                    <x-input-error :messages="$errors->userDeletion->get('event_name')" class="mt-2" />
                </div>
        
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Назад') }}
                    </x-secondary-button>
        
                    <x-danger-button class="ml-3">
                        {{ __('Удалить ивент') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endif
</x-app-layout>