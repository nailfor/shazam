<?php

namespace nailfor\shazam\Providers;

use nailfor\shazam\API\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $controller = '';

    protected string $root = '';

    protected array $routes = [];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->routesAreCached()) {
            return;
        }

        $this->resources = [
            config('shazam.dashboard.ajax'),
        ];
        $this->controller = config('shazam.dashboard.controller');
        $this->root = config('shazam.dashboard.root');

        $path = config('shazam.path');
        $this->path = app_path($path);
        $this->namespace = config('shazam.namespace') . '\\' . str_replace('/', '\\', $path);


        $this->mapRoutes();
        //$this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $web = config('shazam.controller');
        if (!$web) {
            return;
        }

        $data = [
            '/' => $web,
        ];
        Route::group([
                'middleware' => 'web',
                'as' => '/',
            ], Route::resources($data));
    }

    protected function pushRoute(string $resource, array $route, array &$routes): void
    {
        parent::pushRoute($resource, $route, $routes);
        
        $name = $route[0];
        $key = mb_strtolower("{$this->root}/$name");
        $this->routes[$key] = $this->controller;
    }

    protected function loadRoute(string $resource, array $middleware): void
    {
        $this->routes = [];
        parent::loadRoute($resource, $middleware);
        if (!$this->routes) {
            return;
        }

        $list = explode('/', $this->root);
        $as = mb_strtolower(end($list));
        $as .= $as ? '.' : null;
        $resource = [
            'middleware' => $middleware,
            'as' => $as,
        ];

        Route::group($resource, fn () => Route::resources($this->routes));
    }
}
