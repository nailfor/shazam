<?php

namespace nailfor\shazam\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use nailfor\shazam\API\Repositories\APIRepository;

abstract class OptionsRepository extends APIRepository implements OptionsInterface
{
    /**
     * Возвращает дополнительные опции репозитория для отображения на странице.
     *
     * @return array [key => value]
     */
    protected function options(Request $request): array
    {
        return [];
    }

    public function getOptions(Request $request): array
    {
        return array_merge([
            'user' => Auth::user(),
        ], $this->options($request));
    }
}
