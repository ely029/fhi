<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseManagementLaboratoryResults extends Model
{
    use HasFactory;

    protected $table = 'case_management_laboratory_results';
    protected $fillable = [
        'form_id',
        'cxr_date',
        'label',
        'latest_comparative_cxr_reading',
        'cxr_result',
        'ct_scan_date',
        'ct_scan_result',
        'ultra_sound_result',
        'ultra_sound_date',
        'histhopathological_date',
        'histhopathological_result',
        'remarks',
    ];

    protected $dates = [
        'cxr_date',
        'ct_scan_date',
        'ultra_sound_date',
        'histhopathological_date',
    ];
}
