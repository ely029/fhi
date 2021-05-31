<?php

declare(strict_types=1);

namespace App\Models\Filters;

use App\Models\Filters\Filters as filter;

class RoleRequestFilters extends filter
{
    protected $filters = [
        'role',
    ];

    protected function role($string)
    {
        return $this->builder
            ->where('role_id', '=', $string);
    }
}
