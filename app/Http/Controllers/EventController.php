<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function event($id) {
        $event = Event::find($id);
        return view('events.card', compact('event'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function new(Request $request)
    {
        // Валидация данных
        $request->validate([
            'english_name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'background_colour' => 'required',
        ]);

        // Создание новой книги
        Event::create($request->all());

        // Перенаправление на какую-либо страницу (например, список книг)
        return redirect()->route('events.index');
    }

}
