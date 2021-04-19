<?php

declare(strict_types=1);

namespace App\Models\Filters;

use App\Models\Filters\Filters as filter;

class TBMacFormFilters extends filter
{
    protected $filters = [
        'status',
    ];

    protected function status($string)
    {
        return $this->builder
            ->where('status', '=', $string);
    }
}
