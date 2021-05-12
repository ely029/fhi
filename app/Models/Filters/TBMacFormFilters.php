<?php

declare(strict_types=1);

namespace App\Models\Filters;

use App\Models\Filters\Filters as filter;

class TBMacFormFilters extends filter
{
    protected $filters = [
        'status', 'tab', 'casetab',
    ];

    protected function status($string)
    {
        return $this->builder
            ->where('status', '=', $string);
    }

    protected function tab($string)
    {
        return $this->builder
            ->whereIn('status', enrollmentFormTabs()[$string]);
    }

    protected function casetab($string)
    {
        return $this->builder
            ->whereIn('status', caseManagementTabs()[$string]);
    }

    protected function treatmentOutcomeTab($string)
    {
        return $this->builder
            ->whereIn('status', treatmentOutcomeTabs()[$string]);
    }
}
