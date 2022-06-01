<?php

namespace Updivision\Datatable\Core\Collections;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class ActionsCollection
 *
 * @package Updivision\DataTable\Core\Collections
 */
class ActionsCollection extends Collection
{
    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::first($this->items, function ($item) use ($key) {
            return $item->name === $key;
        }, $default);
    }
}