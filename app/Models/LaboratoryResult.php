<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LaboratoryResult
 *
 * @property int $id
 * @property int $form_id
 * @property \Illuminate\Support\Carbon|null $cxr_date
 * @property array|null $cxr_reading
 * @property string|null $cxr_result
 * @property \Illuminate\Support\Carbon|null $ct_scan_date
 * @property string|null $ct_scan_result
 * @property \Illuminate\Support\Carbon|null $ultrasound_date
 * @property string|null $ultrasound_result
 * @property \Illuminate\Support\Carbon|null
 *  $hispathological_date
 * @property string|null $hispathological_result
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereCtScanDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereCtScanResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereCxrDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereCxrReading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereCxrResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereHistopathologicalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereHistopathologicalResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereUltrasoundDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereUltrasoundResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaboratoryResult whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'cxr_reading' => 'array',
    ];

    protected $dates = [
        'ct_scan_date',
        'ultrasound_date',
        'histopathological_date',
        'cxr_date',
    ];
}
