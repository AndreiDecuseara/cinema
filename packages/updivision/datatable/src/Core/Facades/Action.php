<?php

namespace Updivision\Datatable\Core\Facades;

use Exception;
use InvalidArgumentException;
use ReflectionMethod;
use Updivision\Datatable\Core\Actions\DeleteAction;
use Updivision\Datatable\Core\Actions\EditAction;
use Updivision\Datatable\Core\Actions\LinkAction;

/**
 * Class Action
 *
 * @method static LinkAction link(string $name)
 * @method static EditAction edit(string $route, array $routeParameters = [], string $name = null)
 * @method static DeleteAction delete(string $name = null)
 *
 * @package Updivision\DataTable\Core\Facades
 */
class Action
{
    /** @var array|string[] */
    public static array $available_actions = [
        'link' => LinkAction::class,
        'edit' => EditAction::class,
        'delete' => DeleteAction::class,
    ];

    /**
     * @static
     * @param $actionType
     * @param $arguments
     * @return \Updivision\Datatable\Core\Facades\Column|mixed
     * @throws \Exception
     */
    public static function __callStatic($actionType, $arguments)
    {
        if (!in_array($actionType, array_keys(static::$available_actions))) {
            return static::missingActionTypeException($actionType);
        }

        $actionClass = static::$available_actions[$actionType];


        $params = (new ReflectionMethod($actionClass, '__construct'))->getParameters();
        $params_collection = collect($params);
        $constructor_arguments = [];
        $corrupt_arguments = [];

        foreach ($arguments as $key => $value) {
            $param = $params_collection->filter(function ($param) use ($key) {
                return $param->getPosition() === $key;
            })->first();
            if ($param) {
                if (!$param->hasType() || ($param->getType()->allowsNull() || (!$param->getType()->allowsNull() && $param->getType()->getName() === gettype($value)))) {
                    $constructor_arguments[$param->getName()] = $value;
                } else {
                    $corrupt_arguments[] = [
                        'param' => $param,
                        'given_value' => $value,
                        'given_value_is_null' => is_null($value),
                        'given_type' => gettype($value)
                    ];
                }
            }
        }

        $missing_arguments = $params_collection->filter(function ($param) use ($constructor_arguments) {
            return !$param->isOptional() && !in_array($param->getName(), array_keys($constructor_arguments));
        })->toArray();

        if (count($corrupt_arguments)) {
            return static::corruptActionArguments(
                $actionClass,
                '__construct',
                $corrupt_arguments,
                $params
            );
        }

        if (count($missing_arguments)) {
            return static::missingActionArguments(
                $actionClass,
                '__construct',
                $missing_arguments,
                $params
            );
        }

        return new $actionClass(...array_values($constructor_arguments));
    }

    /**
     * @static
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    public static function missingActionTypeException(string $type): mixed
    {
        return throw new Exception("Action type '$type' doesn't exist in available action types: [ '" . collect(self::$available_actions)->keys()->implode("', '") . "' ]");
    }

    /**
     * @static
     * @param string $class
     * @param string $called_function
     * @param array $corrupt_arguments
     * @param array $arguments
     * @return mixed
     */
    public static function corruptActionArguments(string $class, string $called_function, array $corrupt_arguments, array $arguments): mixed
    {
        $corrupt_arguments = collect($corrupt_arguments)->implode(function ($item) {
            return $item['param']->hasType()
                ? (
                    ($item['param']->getType()->allowsNull() === $item['given_value_is_null'] ?: "Argument {$item['param']} is required.") .
                    ($item['param']->getType()->getName() === $item['given_type'] ?: "Expected type '{$item['param']->getType()->getName()}', found '{$item['given_type']}' for attribute {$item['param']}.")
                ) : '';
        }, ' ');
        return throw new InvalidArgumentException("$corrupt_arguments The class method requires the following $class::$called_function(" . implode(', ', $arguments) . ")");
    }

    /**
     * @static
     * @param string $class
     * @param string $called_function
     * @param array $missing_arguments
     * @param array $arguments
     * @return mixed
     */
    public static function missingActionArguments(string $class, string $called_function, array $missing_arguments, array $arguments): mixed
    {
        $missing_arguments = collect($missing_arguments)->implode(function ($item) {
            return "Parameter #{$item->getPosition()}";
        }, ', ');
        return throw new InvalidArgumentException("Arguments ($missing_arguments) are missing from the class method $class::$called_function(" . implode(', ', $arguments) . ")");
    }
}