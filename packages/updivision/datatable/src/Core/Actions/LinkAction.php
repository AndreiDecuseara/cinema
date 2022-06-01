<?php

namespace Updivision\Datatable\Core\Actions;

use Updivision\Datatable\Core\Abstracts\DataTableAction;

/**
 * Class LinkAction
 *
 * @package Updivision\DataTable\Core\Facades
 */
class LinkAction extends DataTableAction
{
    /** @var string */
    public string $route;

    /** @var array */
    public array $routeParameters = [];

    /**
     * @param $entity
     * @return string
     */
    public function resolveData($entity)
    {
        return "<a href='{$this->getRoute($entity)}' {$this->renderAttributes()}>{$this->text}</a>";
    }

    /**
     * @param $entity
     * @return string
     */
    public function getRoute($entity)
    {
        $parameters = collect($this->routeParameters)->mapWithKeys(function ($item) use ($entity) {
            return [$item => $entity->{$item} ?? null];
        })->toArray();
        return route($this->route, collect($parameters)->only($this->routeParameters)->toArray());
    }

    /**
     * @param string $route
     * @param string[] $routeParameters
     * @return $this
     */
    public function setRoute(string $route, array $routeParameters = [])
    {
        $this->route = $route;
        $this->routeParameters = $routeParameters;

        return $this;
    }
}