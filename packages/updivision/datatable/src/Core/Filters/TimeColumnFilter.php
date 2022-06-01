<?php

namespace Updivision\Datatable\Core\Filters;

use Carbon\Carbon;
use Exception;
use Updivision\Datatable\Core\Abstracts\DataTableFilter;

/**
 * Class TimeColumn
 *
 * @package Updivision\DataTable\Core\Filters
 */
class TimeColumnFilter extends DataTableFilter
{
    /** @var string */
    public string $type = 'time';

    /** @var string */
    public string $format = 'H:i:s';

    /**
     * @param $query
     * @param array $value
     * @return mixed
     */
    public function setQuery($query, array $value)
    {
        $value = $this->getTimeInterval($value);

        return $query
            ->when($value['start_time'], function ($query, $start_time) {
                return $query->whereTime($this->attribute, '>=', $start_time);
            })
            ->when($value['end_time'], function ($query, $end_time) {
                return $query->whereTime($this->attribute, '<=', $end_time);
            });
    }

    /**
     * @param $dates
     * @return null[]
     */
    public function getTimeInterval($dates)
    {
        if (isset($dates['start_time'])) {
            try {
                $start_time = Carbon::parse($dates['start_time'])->format($this->format);
            } catch (Exception $exception) {
                $start_time = null;
            }
        } else $start_time = null;

        if (isset($dates['end_time'])) {
            try {
                $end_time = Carbon::parse($dates['end_time'])->format($this->format);
            } catch (Exception $exception) {
                $end_time = null;
            }
        } else $end_time = null;

        return [
            'start_time' => $start_time,
            'end_time' => $end_time
        ];
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

    /**
     * @return string
     */
    public function view()
    {
        return 'datatable::filters.time-column-filter';
    }
}