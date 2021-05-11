<?php

declare(strict_types=1);

namespace App\Models;

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
class TreatmentOutcomeBacteriologicalResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'date_collected',
        'resistance_pattern',
        'method_used',
        'smear_microscopy',
        'tb_lamp',
        'culture',
        'resistance_pattern_others',
    ];

    protected $dates = [
        'date_collected',
    ];
}
