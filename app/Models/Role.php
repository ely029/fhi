<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property int $is_for_admin
 * @property int $is_deletable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoleAccess[] $accesses
 * @property-read int|null $accesses_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\RoleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereIsDeletable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereIsForAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    use HasFactory;
    // Improves performance since hasAccess is always called in the middleware
    // protected $with = ['accesses'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accesses()
    {
        return $this->hasMany(RoleAccess::class);
    }

    public function hasAccess($route)
    {
        return $this->accesses()->where('route', $route)->exists();
    }

    public function getNameAttribute($value)
    {
        switch ($this->id) {
            case 5:
                return 'R-TB MAC';
            case 6:
                return 'R-TB MAC Chair';
            case 7:
                return 'N-TB MAC';
            case 8:
                return 'N-TB MAC Chair';
            default:
                return $value;
        }
    }
}
