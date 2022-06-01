<?php

namespace Updivision\Datatable\Core\Collections;

use Updivision\DataTable\Core\Collections\m;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class FiltersCollection
 *
 * @package Updivision\DataTable\Core\Collections
 */
class FiltersCollection extends Collection
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

    /**
     * @param array $values
     * @return \Updivision\DataTable\Core\Collections\FiltersCollection|\Illuminate\Support\Collection|m.\Updivision\DataTable\Core\Collections\FiltersCollection.mapWithKeys
     */
    public function setValues(array $values)
    {
        if (empty($values)) {
            $this->each(function ($filter) {
                $filter->setValue(null);
            });
        }

        foreach ($values as $filter => $value) {
            $filterIndex = $this->search(function ($item) use ($filter) {
                return $item->name === $filter;
            });

            if (is_numeric($filterIndex)) {
                $this->items[$filterIndex]->setValue($value);
            }
        }

        return $this->getValues();
    }

    /**
     * @return \Updivision\DataTable\Core\Collections\FiltersCollection|\Illuminate\Support\Collection|m.\Updivision\DataTable\Core\Collections\FiltersCollection.mapWithKeys
     */
    public function getValues()
    {
        return $this->mapWithKeys(function ($filter) {
            return [$filter->name => $filter->value()];
        });
    }

    /**
     * @return bool
     */
    public function hasValues()
    {
        return $this->filter(function ($item) {
            return !is_null($item->value());
        })->isNotEmpty();
    }

    /**
     * @return \Updivision\DataTable\Core\Collections\FiltersCollection|m.\Updivision\DataTable\Core\Collections\FiltersCollection.filter
     */
    public function whereNotNullValue()
    {
        return $this->filter(function ($item) {
            return !is_null($item->value());
        });
    }
}