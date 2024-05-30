<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Добавить ивент') }}
        </h2>
    </x-slot>

    <!-- Вывод ошибок валидации -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.new') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="english_name">Англ. название:</label>
            <input type="text" id="english_name" name="english_name" value="{{ old('english_name') }}">
        </div>
        <div>
            <label for="title">Заголовок:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label for="background_colour">Background colour:</label>
            <input type="text" id="background_colour" name="background_colour" value="{{ old('background_colour') }}">
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="image">Картинка:</label>
            <input type="file" id="image" name="image">
        </div>
        <div>
            <label for="image_alt">Опишите картинку:</label>
            <input type="text" id="image_alt" name="image_alt">
        </div>
        <button type="submit">Создать</button>
    </form>
</x-app-layout>
