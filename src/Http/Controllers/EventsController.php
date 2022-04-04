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

//        return EventCollection::collection($events);
        return response()->json(EventCollection::collection($events));
    }

    public function items(Request $request)
    {
        $itemIds = [
            1 => 'Uno',
            2 => 'Dos',
            3 => 'Tres',
            4 => 'Cuatro'
        ];
        return response()->json(EventCollection::collection($itemIds));
    }
}
