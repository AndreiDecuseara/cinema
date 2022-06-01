<?php

namespace Updivision\Datatable\Core\Columns;

use Carbon\Carbon;
use Exception;
use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class DateColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class DateColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'date';

    /** @var string */
    public string $format = 'Y-m-d';

    /**
     * Resolve Data
     *
     * @param $data
     * @param $entity
     * @return string
     */
    public function resolveData($data, $entity): string
    {
        try {
            return Carbon::parse($data)->format($this->format);
        } catch (Exception $exception) {
            return $data;
        }
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }
}