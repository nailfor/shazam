<?php

namespace nailfor\shazam\Repositories;

interface ReferenceInterface
{
    /**
     * Вызывается из модели files\Reference.
     */
    public function getProperty(): array;
}
