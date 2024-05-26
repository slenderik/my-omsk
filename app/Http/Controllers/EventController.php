<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function events() {
        $events = Event::all();
        return view('event_list', compact('events'));
    }

    public function event($id) {
        $event = Event::find($id);
        return view('event_card', compact('event'));
    }
}
