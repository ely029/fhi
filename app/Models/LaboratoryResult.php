<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'ct_scan_date',
        'ct_scan_result',
        'ultrasound_date',
        'ultrasound_result',
        'histopathological_date',
        'histopathological_result',
        'cxr_date','cxr_reading','cxr_result',
        'remarks',
    ];

    protected $casts = [
        'cxr_reading' => 'array'
    ];

    protected $dates = [
        'ct_scan_date',
        'ultrasound_date',
        'histopathological_date',
        'cxr_date'
    ];
}
