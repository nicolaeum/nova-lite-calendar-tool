<?php

namespace Nicolaeum\NovaCalendarTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Event extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'start'  => 'datetime',
        'end'    => 'datetime'
    ];

    public function getTable()
    {
        return config('nova-lite-calendar-tool.model_table');
    }

    public function scopeFilter($query, $data)
    {
        if (!empty($data['start'])) {
            $query->where('start', '>=', $data['start']);
        }

        if (!empty($data['end'])) {
            $query->where('end', '<=', $data['end']);
        }

        if (!empty($data['itemSelectedId'])) {
            $query->where(
                config('nova-lite-calendar-tool.item_model_key_on_event_table'),
                $data['itemSelectedId']
            );
        }

        return $query;
    }
}
