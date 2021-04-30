<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseManagementBacteriologicalResults extends Model
{
    use HasFactory;

    protected $table = 'case_management_bacteriological_results';

    protected $fillable = [
        'form_id',
        'label',
        'date_collected',
        'resistance_pattern',
        'method_used',
        'smear_microscopy',
        'tb_lamp',
        'culture',
    ];

    protected $dates = [
        'date_collected',
    ];

    public function lpaCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'LPA',
            'date_collected' => ! isset($request['date_collected_lpa']) ? Carbon::now()->timestamp : $request['date_collected_lpa'],
            'resistance_pattern' => ! isset($request['resistance_pattern_lpa']) ? '' : $request['resistance_pattern_lpa'],
            'form_id' => $form->id,
        ]);
    }

    public function dstCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'DST',
            'date_collected' => ! isset($request['date_collected_dst']) ? Carbon::now()->timestamp : $request['date_collected_dst'],
            'resistance_pattern' => ! isset($request['resistance_pattern_dst']) ? '' : $request['resistance_pattern_dst'],
            'form_id' => $form->id,
        ]);
    }

    public function screeningOneCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
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
        CaseManagementBacteriologicalResults::create([
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

    public function monthDSTCreation($screen, $eee, $request, $form)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'Screening '. $screen,
            'date_collected' => ! isset($request['date_collected'][$eee]) ? Carbon::now()->timestamp : $request['date_collected'][$eee],
            'smear_microscopy' => $request['smear_microscopy'][$eee],
            'tb_lamp' => $request['tb_lamp'][$eee],
            'culture' => $request['culture'][$eee],
            'form_id' => $form->id,
        ]);
    }

    public function monthDSTCreationMobile($screen, $eee, $request, $form)
    {
        $item = json_decode($request['month_dst'], true);
        CaseManagementBacteriologicalResults::create([
            'label' => 'Screening '. $screen,
            'date_collected' => ! isset($item[$eee]['date_collected']) ? Carbon::now()->timestamp : $item[$eee]['date_collected'],
            'smear_microscopy' => $item[$eee]['smear_microscopy'],
            'tb_lamp' => $item[$eee]['tb_lamp'],
            'culture' => $item[$eee]['culture'],
            'form_id' => $form->id,
        ]);
    }

    public function tbMacForm()
    {
        return $this->hasOne(TBMacForm::class, 'id');
    }
}
