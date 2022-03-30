<?php

namespace Nicolaeum\NovaCalendarTool\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $map    = config('nova-lite-calendar-tool.resource_map');
        $mapped = [
            'title' => $map['title'] ? $this->{$map['title']} : null,
            'start' => $map['start'] ? $this->{$map['start']} : null,
            'end'   => $map['end'] ? $this->{$map['end']} : null,
        ];

        return $mapped;
    }
}
