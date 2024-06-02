<x-app-layout>
    <x-jquery />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Создать ивент') }}
        </h2>
    </x-slot>

    <div>
        <x-input-label for="english_name" :value="__('Англ. название')" />
        <x-input-autocomplete url="/api/organization" inputId="item-input" suggestionId="suggestions" placeholder="аним"/>
        <x-input-error :messages="$errors->get('english_name')" class="mt-2" />
    </div>
</x-app-layout>
