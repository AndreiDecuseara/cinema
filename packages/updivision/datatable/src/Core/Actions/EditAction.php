<?php

namespace Updivision\Datatable\Core\Actions;

use Updivision\Datatable\Core\Abstracts\DataTableAction;

/**
 * Class EditAction
 *
 * @package Updivision\DataTable\Core\Actions
 */
class EditAction extends DataTableAction
{
    /** @var string */
    public string $name = 'edit';

    /** @var string */
    public string $text = 'Edit';

    /** @var string|null */
    public string|null $route;

    /** @var array */
    public array $routeParameters = [];

    /**
     * @param string $route
     * @param array $routeParameters
     * @param string|null $name
     */
    public function __construct(string $route, array $routeParameters = [], string $name = null)
    {
        $this->route = $route;
        $this->routeParameters = $routeParameters;
        parent::__construct($name ?? $this->name);
    }

    /**
     * @param $entity
     * @return string
     */
    public function resolveData($entity)
    {
        return view('datatable::actions.edit', [
            'action' => $this,
            'entity' => $entity,
        ])->render();
    }

    /**
     * @param $entity
     * @return string
     */
    public function getRoute($entity)
    {
        $parameters = collect($this->routeParameters)->mapWithKeys(function ($attribute, $parameter) use ($entity) {
            return [$parameter => $entity->{$attribute} ?? null];
        })->toArray();
        return route($this->route, $parameters);
    }

    /**
     * @param string $route
     * @param string[] $routeParameters
     * @return $this
     */
    public function setRoute(string $route, array $routeParameters)
    {
        $this->route = $route;
        $this->routeParameters = $routeParameters;

        return $this;
    }
}