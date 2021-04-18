<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'birthday'
    ];

    public function getAgeAttribute()
    {
        return $this->birthday->age;
    }

    public function getGenderInitialAttribute()
    {
        return Str::upper(Str::substr($this->gender,0,1));
    }

    public function getInitialsAttribute()
    {
        return Str::upper(Str::substr($this->first_name,0,1).Str::substr($this->middle_name,0,1).Str::substr($this->last_name,0,1));
    }

    public function getCodeAttribute()
    {
        return $this->initials.' '.$this->age.' '.$this->gender_initial;
    }
}
