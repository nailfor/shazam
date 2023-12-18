<?php

use nailfor\shazam\API\Models\Paginator;
use nailfor\shazam\Http\Controllers\WebController;

return [
    'namespace' => 'App',
    'path' => 'Http/Controllers',
    'dashboard' => [
        'controller' => WebController::class,
        'root' => 'admin',
        'ajax' => 'Ajax',
    ],
    'routes' => [
        'API',
    ],
    'view' => [
        'web' => 'vendor.shazam.dashboard',
    ],
    'paginator' => Paginator::class,

    'debug' => env('SQL_DEBUG', false),
];
