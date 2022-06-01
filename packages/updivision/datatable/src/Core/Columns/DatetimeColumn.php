<?php

namespace Updivision\Datatable\Core\Columns;

use Carbon\Carbon;
use Exception;
use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class DatetimeColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class DatetimeColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'datetime';

    /** @var string */
    public string $format = 'Y-m-d H:i:s';

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