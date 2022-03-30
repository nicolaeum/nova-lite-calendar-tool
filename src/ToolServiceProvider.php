<?php

namespace Nicolaeum\NovaCalendarTool;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Nicolaeum\NovaCalendarTool\Http\Middleware\Authorize;
use Nicolaeum\NovaCalendarTool\Models\Event;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-calendar-tool');

        /*$this->publishes([
            __DIR__ . '/../database/migrations/create_events_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_events_table.php'),
        ], 'migrations');*/

        $this->publishes([
            __DIR__.'/config/nova-lite-calendar-tool.php' => config_path('nova-lite-calendar-tool.php'),
        ], 'config');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::provideToScript([
                'fullcalendar_locale' => config('nova-lite-calendar-tool.fullcalendar_locale'),
            ]);
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/nova-lite-calendar-tool')
                ->namespace('Nicolaeum\NovaCalendarTool\Http\Controllers')
                ->group(__DIR__.'/../routes/api.php');

        $this->commands([]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public static function getItemModel()
    {
        return config('nova-lite-calendar-tool.item_model');
    }
}
