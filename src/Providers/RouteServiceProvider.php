<?php

namespace Azuriom\Plugin\CommunityAnalytics\Providers;

use Azuriom\Extensions\Plugin\BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function loadRoutes(): void
    {
        $this->mapApiRoutes();

        $this->mapPluginsRoutes();

        $this->mapAdminRoutes();
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api/' . $this->plugin->id)
            ->middleware('api')
            ->name($this->plugin->id . '.api.')
            ->group(plugin_path($this->plugin->id . '/routes/api.php'));
    }

    protected function mapPluginsRoutes(): void
    {
        Route::prefix($this->plugin->id)
            ->middleware('web')
            ->name($this->plugin->id . '.')
            ->group(plugin_path($this->plugin->id . '/routes/web.php'));
    }

    protected function mapAdminRoutes(): void
    {
        Route::prefix('admin/' . $this->plugin->id)
            ->middleware('admin-access')
            ->name($this->plugin->id . '.admin.')
            ->group(plugin_path($this->plugin->id . '/routes/admin.php'));
    }
}
