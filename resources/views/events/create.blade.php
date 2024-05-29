<!DOCTYPE html>
<html>
<head>
    <title>Create event</title>
</head>
<body>
    <h1>Create a new Book</h1>

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

    <form action="{{ route('events.new') }}" method="POST">
        @csrf
        <div>
            <label for="english_name">Eng. name:</label>
            <input type="text" id="english_name" name="english_name" value="{{ old('english_name') }}">
        </div>
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label for="background_colour">Background colour:</label>
            <input type="text" id="background_colour" name="background_colour" value="{{ old('background_colour') }}">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit">Create</button>
    </form>
</body>
</html>
