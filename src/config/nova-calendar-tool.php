<?php

return [
    // Calendar language (more info: https://fullcalendar.io/docs/locale)
    'fullcalendar_locale'   => 'en',
    'model_table'           => 'property_bookings',
    'resource_map'          => [
        'title' => 'booking_source',
        'start' => 'start',
        'end'   => 'end'
    ],
    'item_model'                                    => null,
    'item_model_key_on_event_table'                 => null,
    'item_field_to_be_added_to_title'               => null,
    'item_field_to_query_dropdown_items'            => null,
    'item_operation_type_to_query_dropdown_items'   => null,
    'resource_to_link_on_calendar_event'            => null
];
