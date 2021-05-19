<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TreatmentOutcomeBacteriologicalResult
 *
 * @property int $id
 * @property int $form_id
 * @property string $type
 * @property \Illuminate\Support\Carbon $date_collected
 * @property string|null $method_used
 * @property string|null $resistance_pattern
 * @property string|null $smear_microscopy
 * @property string|null $tb_lamp
 * @property string|null $culture
 * @property string|null $resistance_pattern_others
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereCulture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereDateCollected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereMethodUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereResistancePattern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereResistancePatternOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereSmearMicroscopy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereTbLamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentOutcomeBacteriologicalResult whereUpdatedAt($value)
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
