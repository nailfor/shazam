<?php

namespace nailfor\shazam\Repositories;

class ReferenceRepository extends AbstractRootRepository implements ReferenceInterface
{
    protected static string $name;

    public function getProperty(): array
    {
        $ajax = mb_strtolower(config('shazam.dashboard.ajax'));
        $name = static::$name;

        return [
            'url' => "/{$ajax}/{$name}",
            'title' => __("{$name}.breadcrumbs"),
            'breadcrumbs' => $this->getBreadcrumbs(),
            'header' => $this->getHeader(),
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $root = mb_strtolower(config('shazam.dashboard.root'));

        $breadcrumbs = parent::getBreadcrumbs();
        $name = static::$name;
        $breadcrumbs[] = [
            'title' => __("{$name}.title"),
            'url' => "/{$root}/{$name}",
        ];

        return $breadcrumbs;
    }

    protected function getHeader(): array
    {
        return [
            'id' => 'Id',
            'name' => __('name'),
        ];
    }
}
