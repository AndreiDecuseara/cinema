<?php

namespace Updivision\Datatable\Core\Collections;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Laravel\SerializableClosure\SerializableClosure;

/**
 * Class ColumnsCollection
 *
 * @package Updivision\DataTable\Core\Collections
 */
class ColumnsCollection extends Collection
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