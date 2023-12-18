<?php

namespace nailfor\shazam\Repositories;

use Illuminate\Http\Request;

interface OptionsInterface
{
    /**
     * Возвращает параметры для рендеринга.
     *
     * @param Request $request запрос пользователя
     */
    public function getOptions(Request $request): array;
}
