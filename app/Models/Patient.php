<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Patient
 *
 * @property int $id
 * @property int $is_from_itis
 * @property string|null $facility_code
 * @property string|null $province
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon $birthday
 * @property string $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $age
 * @property-read mixed $code
 * @property-read mixed $gender_initial
 * @property-read mixed $initials
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFacilityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereIsFromItis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_from_itis',
        'facility_code',
        'province',
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'gender',
    ];

    protected $dates = [
        'birthday',
    ];

    public function getAgeAttribute()
    {
        return $this->birthday->age;
    }

    public function getGenderInitialAttribute()
    {
        return Str::upper(Str::substr($this->gender, 0, 1));
    }

    public function getInitialsAttribute()
    {
        return Str::upper(Str::substr($this->first_name, 0, 1).Str::substr($this->middle_name, 0, 1).Str::substr($this->last_name, 0, 1));
    }

    public function getCodeAttribute()
    {
        return $this->initials.$this->age.$this->gender_initial;
    }
}
