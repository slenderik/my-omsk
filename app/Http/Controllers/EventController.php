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
        $request->validate([
            'english_name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'background_colour' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alt' => 'required|max:255',
        ]);
        
        // Сохранение фото
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('images', $imageName, 'public');
        
        // Создание ивента
        $event = Event::create($request->all());

        // Сохранение пути к изображению в базе данных или другие действия
        $eventId = $event->id;
        $imageAlt = $request->image_alt;
        
        $imageRequest = [
            'event_id' => $eventId,
            'image_name' => $imageName,
            'image_alt' => $imageAlt,
        ];
        EventImage::create($imageRequest);
        
        // Перенаправление на какую-либо страницу (например, список книг)
        return redirect()->route('events.index');
    }

}
