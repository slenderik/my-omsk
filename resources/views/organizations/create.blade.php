<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Добавить организацию') }}
        </h2>
    </x-slot>

    <form action="{{ route('api.organization.create') }}" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="logo" :value="__('Логотип')" />
            <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Название организации')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Культурный домик"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Описание организации')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" placeholder="Культурное место."/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Добавить организацию') }}</x-primary-button>

            @if (session('status') === 'events-new')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Организация добавлена.') }}</p>
            @endif
        </div>   
    </form>
</x-app-layout>
