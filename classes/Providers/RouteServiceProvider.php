<?php

namespace App\WordPress\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\WordPress\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Define the routes for the addon.
     *
     * @param \Illuminate\Routing\Router $router (injection)
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['prefix' => addon()->config('wordpress.url.backend_prefix'), 'namespace' => $this->namespace], function ($router) {
            require __DIR__.'/../Http/backend-routes.php';
        });

        $router->group(['prefix' => addon()->config('wordpress.url.site_prefix'), 'namespace' => $this->namespace], function ($router) {
            require __DIR__.'/../Http/site-routes.php';
        });
    }
}
