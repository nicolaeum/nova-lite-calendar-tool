<?php

namespace Nicolaeum\NovaCalendarTool\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Nicolaeum\NovaCalendarTool\ToolServiceProvider;

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
        $map = config('nova-lite-calendar-tool.resource_map');

        $itemModel  = ToolServiceProvider::getItemModel();
        $item       = $itemModel::find($this->{config('nova-lite-calendar-tool.item_model_key_on_event_table')});
        $title      = false;

        if ($item) {
            $title = $item->reference;
        }

        if (!empty($map['title'])) {
            $title = implode(' - ', [
                $title,
                $this->{$map['title']}
            ]);
        }

        /*$data = [
            'id'    => $this->id,
            'title' => $title,
            'start' => $map['start'] ? $this->{$map['start']} : null,
            'end'   => $map['end'] ? $this->{$map['end']} : null,
        ];*/

        $data = [
            'id'    => $this->id,
            'title' => $title,
            'start' => $map['start'] ? $this->{$map['start']}->toDateString() : null,
            'end'   => $map['end'] ? $this->{$map['end']}->toDateString() : null,
            'url'   => (config('nova-lite-calendar-tool.resource_to_link_on_calendar_event'))
                ? url('nova/resources/' . config('nova-lite-calendar-tool.resource_to_link_on_calendar_event') . '/' . $this->id)
                : null
        ];

        return $data;
    }
}
