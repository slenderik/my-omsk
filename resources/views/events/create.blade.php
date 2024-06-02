<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Добавить ивент') }}
        </h2>
    </x-slot>

    <x-jquery />

    <form action="{{ route('events.new') }}" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="english_name" :value="__('Англ. название')" />
            <x-text-input id="english_name" name="english_name" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('english_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="title" :value="__('Заголовок')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="background_colour" :value="__('Фоновый цвет')" />
            <x-text-input id="background_colour" name="background_colour" type="color" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('background_colour')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Описание')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Картинка')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image_alt" :value="__('Описание картинки')" />
            <x-text-input id="image_alt" name="image_alt" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('image_alt')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="organization" :value="__('Организация')" />
            <x-input-autocomplete url="/api/organization" inputId="organization" suggestionId="suggestions"/>
            <x-input-error :messages="$errors->get('organization')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Добавить ивент') }}</x-primary-button>

            @if (session('status') === 'events-new')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Ивент добавлен.') }}</p>
            @endif
        </div>   
    </form>
</x-app-layout>
