<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CaseManagementLaboratoryResults
 *
 * @property int $id
 * @property int $form_id
 * @property \Illuminate\Support\Carbon $cxr_date
 * @property string $label
 * @property string $latest_comparative_cxr_reading
 * @property string $cxr_result
 * @property \Illuminate\Support\Carbon $ct_scan_date
 * @property string $ct_scan_result
 * @property \Illuminate\Support\Carbon $ultra_sound_date
 * @property \Illuminate\Support\Carbon $histhopathological_date
 * @property string $histhopathological_result
 * @property string $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $ultra_sound_result
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereCtScanDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereCtScanResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereCxrDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereCxrResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereHisthopathologicalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereHisthopathologicalResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereLatestComparativeCxrReading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereUltraSoundDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereUltraSoundResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementLaboratoryResults whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CaseManagementLaboratoryResults extends Model
{
    use HasFactory;

    protected $table = 'case_management_laboratory_results';
    protected $fillable = [
        'form_id',
        'cxr_date',
        'label',
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
