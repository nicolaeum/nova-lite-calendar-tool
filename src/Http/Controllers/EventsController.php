<?php

namespace Nicolaeum\NovaCalendarTool\Http\Controllers;

use Nicolaeum\NovaCalendarTool\Http\Resources\EventCollection;
use Nicolaeum\NovaCalendarTool\Models\Event;
use Illuminate\Http\Request;

class EventsController
{
    public function index(Request $request)
    {
//        dd(Event::filter($request->query())->toSql(['booking_source', 'from', 'to']));
        $events = Event::filter($request->query())
            ->get(['booking_source', 'start', 'end']);
//dd($events);
        return EventCollection::collection($events);
    }
}
