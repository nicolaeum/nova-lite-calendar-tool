<?php

namespace Nicolaeum\NovaCalendarTool\Http\Controllers;

use Nicolaeum\NovaCalendarTool\Http\Resources\EventCollection;
use Nicolaeum\NovaCalendarTool\Models\Event;
use Illuminate\Http\Request;

class EventsController
{
    public function index(Request $request)
    {
        $events = Event::filter($request->query())
            ->get();

        $items_id = [
            1 => 'Uno',
            2 => 'Dos',
            3 => 'Tres',
            4 => 'Cuatro'
        ];

//        return EventCollection::collection($events);
        return response()->json(['items_id' => $items_id, 'events' => EventCollection::collection($events)]);
    }
}
