<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CaseManagementBacteriologicalResults
 *
 * @property int $id
 * @property int $form_id
 * @property string $label
 * @property \Illuminate\Support\Carbon $date_collected
 * @property string $resistance_pattern
 * @property string $method_used
 * @property string $smear_microscopy
 * @property string $tb_lamp
 * @property string $culture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TBMacForm|null $tbMacForm
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereCulture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereDateCollected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereMethodUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereResistancePattern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereSmearMicroscopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereTbLamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementBacteriologicalResults whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'others',
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
            'others' => ! isset($request['others_bacteriological_results']) ? '' : $request['others_bacteriological_results'],
        ]);
    }

    public function screeningOneCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'Screening 1',
            'form_id' => $form->id,
            'date_collected' => ! isset($request['date_collected_screening_1']) ? '' : $request['date_collected_screening_1'],
            'resistance_pattern' => ! isset($request['ressitance_pattern_screening_1']) ? '' : $request['ressitance_pattern_screening_1'],
            'method_used' => ! isset($request['method_used_screening_1']) ? '' : $request['method_used_screening_1'],
            'cxr_date' => Carbon::now()->timestamp,
            'ct_scan_date' => Carbon::now()->timestamp,
            'histhopathological_date' => Carbon::now()->timestamp,
            'histhopathological_result' => ! isset($request['histhopathological_result']) ? '' : $request['histhopathological_result'],
        ]);
    }

    public function screeningOneUpdate($form, $request)
    {
        CaseManagementBacteriologicalResults::where(['form_id' => $form->id, 'label' => 'Screening 1'])->update([
            'label' => 'Screening 1',
            'date_collected' => ! isset($request['date_collected_screening_1']) ? '' : $request['date_collected_screening_1'],
            'resistance_pattern' => ! isset($request['ressitance_pattern_screening_1']) ? '' : $request['ressitance_pattern_screening_1'],
            'method_used' => ! isset($request['method_used_screening_1']) ? '' : $request['method_used_screening_1'],
        ]);
    }

    public function screeningTwoCreation($form, $request)
    {
        CaseManagementBacteriologicalResults::create([
            'label' => 'Screening 2',
            'form_id' => $form->id,
            'date_collected' => ! isset($request['date_collected_screening_2']) ? Carbon::now()->format('Y-m-d') : $request['date_collected_screening_2'],
            'resistance_pattern' => $request['ressitance_pattern_screening_2'] ?? null,
            'method_used' => $request['method_used_screening_2'] ?? null,
            'cxr_date' => Carbon::now()->timestamp,
            'ct_scan_date' => Carbon::now()->timestamp,
            'histhopathological_date' => Carbon::now()->timestamp,
            'histhopathological_result' => ! isset($request['histhopathological_result']) ? '' : $request['histhopathological_result'],
        ]);
    }

    public function screeningTwoUpdate($form, $request)
    {
        CaseManagementBacteriologicalResults::where(['form_id' => $form->id, 'label' => 'Screening 2'])->update([
            'label' => 'Screening 2',
            'date_collected' => ! isset($request['date_collected_screening_2']) ? Carbon::now()->format('Y-m-d') : $request['date_collected_screening_2'],
            'resistance_pattern' => $request['ressitance_pattern_screening_2'] ?? null,
            'method_used' => $request['method_used_screening_2'] ?? null,
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
