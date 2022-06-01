<?php

namespace Updivision\Datatable\Core\Traits;

/**
 * Trait HasPagination
 *
 * @package Updivision\DataTable\Core\Traits
 */
trait HasPagination
{
    /** @var string */
    public string $sortBy;

    /** @var string */
    public string $sortDir;

    /** @var bool */
    public bool $paginate = true;

    /** @var int */
    public int $pageLength = 10;

    /** @var bool */
    public bool $hasQueryStrings = true;

    /**
     * @return int[]
     */
    public function pageLengthMenu(): array
    {
        return [10, 25, 50, 100];
    }
}