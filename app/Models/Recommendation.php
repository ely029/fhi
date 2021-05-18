<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recommendation
 *
 * @property int $id
 * @property int $form_id
 * @property string $recommendation
 * @property string $status
 * @property int $role_id
 * @property int $submitted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Role $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TBMacForm[] $tbMacForm
 * @property-read int|null $tb_mac_form_count
 * @property-read \App\Models\TBMacForm $tbMacForms
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereSubmittedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recommendation extends Model
{
    use HasFactory;

    protected $table = 'recommendation';

    protected $fillable = [
        'form_id',
        'recommendation',
        'status',
        'submitted_by',
        'role_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function tbMacForms()
    {
        return $this->belongsTo(TBMacForm::class, 'form_id');
    }

    public function tbMacForm()
    {
        return $this->hasMany(TBMacForm::class, 'form_id');
    }
}
