<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
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

    public function screeningOneCreation($form, $request)
    {
        CaseManagementLaboratoryResults::create([
            'label' => 'Screening 1',
            'form_id' => $form->id,
            'date_collected' => $request['date_collected_screening_1'],
            'resistance_pattern' => $request['ressitance_pattern_screening_1'],
            'method_used' => ! isset($request['method_used_screening_1']) ? '' : $request['method_used_screening_1'],
            'cxr_date' => Carbon::now()->timestamp,
            'ct_scan_date' => Carbon::now()->timestamp,
            'histhopathological_date' => Carbon::now()->timestamp,
            'histhopathological_result' => ! isset($request['histhopathological_result']) ? '' : $request['histhopathological_result'],
            'remarks' => 'null',
        ]);
    }

    public function screeningTwoCreation($form, $request)
    {
        CaseManagementLaboratoryResults::create([
            'label' => 'Screening 2',
            'form_id' => $form->id,
            'date_collected' => ! isset($request['date_collected_screening_2']) ? Carbon::now()->timestamp : $request['date_collected_screening_2'],
            'resistance_pattern' => $request['ressitance_pattern_screening_2'] ?? null,
            'method_used' => $request['method_used_screening_2'] ?? null,
            'cxr_date' => Carbon::now()->timestamp,
            'ct_scan_date' => Carbon::now()->timestamp,
            'histhopathological_date' => Carbon::now()->timestamp,
            'histhopathological_result' => ! isset($request['histhopathological_result']) ? '' : $request['histhopathological_result'],
            'remarks' => 'null',
        ]);
    }
}
