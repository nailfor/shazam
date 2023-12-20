<?php

namespace nailfor\shazam\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class Reference
{
    protected const REFERENCE = 'reference';
    
    protected const EDIT = 'edit';

    public static function get(): Collection
    {
        $instance = new static();
        $routes = Route::getRoutes();
        $keys = $instance->getKeys($routes);
        $request = request();

        $prefix = mb_strtolower(config('shazam.dashboard.ajax')) . '/';
        $root = mb_strtolower(config('shazam.dashboard.root'));

        $references = collect();
        foreach ($keys as $key) {
            $model = $instance->getModel($routes, $request, $key);
            $name = str_replace($prefix, '', $key);

            $reference = [
                'id' => "$root.$name",
                'title' => __("$name.title"),
                'url' => "/$root/$name",
                'component' => static::REFERENCE,
                'property' => $model->getProperty(),
                'form' => [
                    'component' => static::EDIT,
                    'property' => $model->getForm(),
                ],
            ];

            $references->push($reference);
        }

        return $references;
    }

    protected function getModel($routes, Request $request, string $key)
    {
        $name = str_replace('/', '.', $key);
        $route = $routes->getByName("$name.index");
        $controller = $route->getController();

        return $controller->getModel($request);
    }

    protected function getKeys($routes): array
    {
        $posts = $routes->get('POST');
        $keys = array_keys($posts);
        $key = mb_strtolower(config('shazam.dashboard.ajax') . '/');
        
        return array_filter($keys, fn ($item) => strpos($item, $key) === 0);
    }
}
