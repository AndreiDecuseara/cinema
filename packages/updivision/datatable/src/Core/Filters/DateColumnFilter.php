<?php

namespace Updivision\Datatable\Core\Filters;

use Carbon\Carbon;
use Exception;
use Updivision\Datatable\Core\Abstracts\DataTableFilter;

/**
 * Class DateColumn
 *
 * @package Updivision\DataTable\Core\Filters
 */
class DateColumnFilter extends DataTableFilter
{
    /** @var string */
    public string $type = 'date';

    /** @var string */
    public string $format = 'Y-m-d';

    /**
     * @param $query
     * @param array $value
     * @return mixed
     */
    public function setQuery($query, array $value)
    {
        $value = $this->getDateInterval($value);

        return $query
            ->when($value['start_date'], function ($query, $start_date) {
                return $query->whereDate($this->attribute, '>=', $start_date);
            })
            ->when($value['end_date'], function ($query, $end_date) {
                return $query->whereDate($this->attribute, '<=', $end_date);
            });
    }

    /**
     * @param $dates
     * @return null[]
     */
    public function getDateInterval($dates)
    {
        if (isset($dates['start_date'])) {
            try {
                $start_date = Carbon::parse($dates['start_date'])->format($this->format);
            } catch (Exception $exception) {
                $start_date = null;
            }
        } else $start_date = null;

        if (isset($dates['end_date'])) {
            try {
                $end_date = Carbon::parse($dates['end_date'])->format($this->format);
            } catch (Exception $exception) {
                $end_date = null;
            }
        } else $end_date = null;

        return [
            'start_date' => $start_date,
            'end_date' => $end_date
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
        return 'datatable::filters.date-column-filter';
    }
}