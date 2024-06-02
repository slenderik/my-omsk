<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // $events = Event::all();
        $events = Event::with('eventImage')->get();
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
        $validatedData = $request->validate([
            'english_name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'background_colour' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alt' => 'required|max:255',
            'organization_id' => 'required|exists:organizations,id|max:255', // Важно проверить, что organization_id существует в таблице organizations
        ]);

        // Сохранение фото
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('images', $imageName, 'public');

        // Создание ивента
        $event = Event::create([
            'english_name' => $validatedData['english_name'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'background_colour' => $validatedData['background_colour'],
            'image' => $imageName,
            'image_alt' => $validatedData['image_alt'],
            'organization_id' => $validatedData['organization_id'],
        ]);

        // Сохранение пути к изображению в базе данных
        EventImage::create([
            'event_id' => $event->id,
            'image_name' => $imageName,
            'image_alt' => $validatedData['image_alt'],
        ]);
        
        // Перенаправление на главную
        return redirect()->route('events.index');
    }

}
