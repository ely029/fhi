<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Filters\RoleRequestFilters;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoleRequest
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role $role
 * @mixin \Eloquent
 */

class RoleRequest extends Model
{
    protected $fillable = [
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeFilter($query, RoleRequestFilters $filters)
    {
        return $filters->apply($query);
    }
}
