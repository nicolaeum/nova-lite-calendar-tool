<?php

namespace Nicolaeum\NovaCalendarTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Event extends Model
{
    protected $guarded = ['id'];
//    protected $table = 'property_bookings';
    protected $casts = [
        'from'  => 'datetime',
        'to'    => 'datetime'
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

        return $query;
    }
}
