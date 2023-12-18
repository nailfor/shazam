<?php

namespace nailfor\shazam\Repositories;

use nailfor\shazam\Models\Reference;
use Illuminate\Http\Request;

abstract class AbstractRootRepository extends OptionsRepository
{
    protected function options(Request $request): array
    {
        return [
            'references' => Reference::get(),
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => __('dashboard'),
            'url' => '/',
        ];

        return $breadcrumbs;
    }
}
