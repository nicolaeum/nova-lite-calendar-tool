<?php

namespace Nicolaeum\NovaCalendarTool\Http\Controllers;

use Nicolaeum\NovaCalendarTool\Http\Resources\EventCollection;
use Nicolaeum\NovaCalendarTool\Models\Event;
use Illuminate\Http\Request;
use Nicolaeum\NovaCalendarTool\ToolServiceProvider;

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
        $itemModel  = ToolServiceProvider::getItemModel();
        $rentals    = $itemModel::where(
            $this->{config('nova-lite-calendar-tool.item_field_to_query_dropdown_items')},
            true
        )->get();

        return response()->json(
            $rentals->pluck('reference', 'id')->toArray()
        );
    }
}
