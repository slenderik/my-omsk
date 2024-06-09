<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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

    // VIEW EDTI PAGES
    public function create()
    {
        return view('events.create');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    public function delete($id)
    {
        $event = Event::find($id);
        return view('events.delete', compact('event'));
    }
    //

    // API EVENTS FUNCTIONS
    public function store(Request $request)
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
        $imageName = time() . '_' . pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('images', $imageName, 'public');

        // Создание ивента
        $event = Event::create([
            'english_name' => $validatedData['english_name'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'background_colour' => $validatedData['background_colour'],
            'organization_id' => $validatedData['organization_id'],
        ]);

        // Сохранение пути к изображению в базе данных
        EventImage::create([
            'event_id' => $event->id,
            'image_name' => $imageName,
            'image_alt' => $validatedData['image_alt'],
        ]);
        
        // Перенаправление на главную
        return redirect()->route('events');
    }

    public function update(Request $request, $id)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'english_name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'background_colour' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Обновление изображения не обязательно
            'image_alt' => 'required|max:255',
            'organization_id' => 'required|exists:organizations,id|max:255',
        ]);

        // Поиск события
        $event = Event::findOrFail($id);

        // Обновление данных события
        $event->update([
            'english_name' => $validatedData['english_name'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'background_colour' => $validatedData['background_colour'],
            'organization_id' => $validatedData['organization_id'],
        ]);

        // Обработка изображения, если оно было загружено
        if ($request->hasFile('image')) {
            // Удаление старого изображения (если нужно)
            if ($event->image) {
                Storage::disk('public')->delete('images/' . $event->image->image_name);
            }

            // Сохранение нового изображения
            $imageName = time() . '_' . pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('images', $imageName, 'public');

            // Обновление записи изображения в базе данных
            $eventImage = EventImage::where('event_id', $event->id)->first();
            if ($eventImage) {
                $eventImage->update([
                    'image_name' => $imageName,
                    'image_alt' => $validatedData['image_alt'],
                ]);
            } else {
                EventImage::create([
                    'event_id' => $event->id,
                    'image_name' => $imageName,
                    'image_alt' => $validatedData['image_alt'],
                ]);
            }
        } else {
            // Обновление альт-текста изображения, если изображение не меняется
            $eventImage = EventImage::where('event_id', $event->id)->first();
            if ($eventImage) {
                $eventImage->update([
                    'image_alt' => $validatedData['image_alt'],
                ]);
            }
        }

        // Перенаправление на страницу просмотра события
        return redirect()->route('events', $event->id);
    }


    public function destroy(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($id);

        if ($request->input('event_name') === $event->title) {
            $event->delete();

            return Redirect::route('events')->with('success', __('Ивент успешно удален.'));
        }

        return Redirect::back()->withErrors([
            'event_name' => __('Неверное название ивента.'),
        ]);
    }

}
