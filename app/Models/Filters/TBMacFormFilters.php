<?php

namespace App\Models\Filters;

use App\Models\Filters\Filters;

class TBMacFormFilters extends Filters
{
    protected $filters = [
        'status'
    ];

    protected function status($string)
    {
        return $this->builder
            ->where('status', '=', $string);
    }
}
