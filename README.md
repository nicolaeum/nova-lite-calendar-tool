# Laravel Nova Calendar Tool

This is a package for [Laravel Nova](https://nova.laravel.com/) which allows you to create, update and delete events on the calendar. It also has a Google Calendar integration.

## Screeenshots

![Nova Calendar Tool - screen 1](https://paweldymek.com/projects/nova-calendar-tool/screen_1.png)

[//]: # (![Nova Calendar Tool - screen 2]&#40;https://paweldymek.com/projects/nova-calendar-tool/screen_2.png&#41;)
[//]: # (![Nova Calendar Tool - screen 3]&#40;https://paweldymek.com/projects/nova-calendar-tool/screen_3.png&#41;)

## Requirements

* PHP >= 7.1
* [Laravel](https://laravel.com/) application with [Laravel Nova](https://nova.laravel.com/) installed

## Installation

Install the package via composer:

```
composer require nicolaeum/nova-lite-calendar-tool
```

Publish the config (optional):
```
php artisan vendor:publish --provider='nicolaeum\NovaCalendarTool\ToolServiceProvider' --tag="config"
```

Register the tool in the `tools` method of the `NovaServiceProvider`:
```
// app/Providers/NovaServiceProvider.php

// ...

public function tools()
{
    return [
        // ...
        new \nicolaeum\NovaCalendarTool\NovaCalendarTool,
    ];
}
```

## Credits
* [Laravel Nova Calendar Tool](https://github.com/czemu/nova-calendar-tool) (Forked from)
* [FullCalendar](https://fullcalendar.io/)
* [Laravel](https://laravel.com/)
* [Laravel Nova](https://nova.laravel.com/)
* [spatie/laravel-google-calendar](https://github.com/spatie/laravel-google-calendar)

## License

The MIT License (MIT). Please see the [LICENSE.md](LICENSE.md) file for more information.
