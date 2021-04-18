<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

/**
 * App\Models\BacteriologicalResult
 *
 * @property int $id
 * @property int $form_id
 * @property string $type
 * @property \Illuminate\Support\Carbon $date_collected
 * @property string $name_of_laboratory
 * @property string $result
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereDateCollected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereNameOfLaboratory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacteriologicalResult whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BacteriologicalResult extends Model
{
    use HasFactory;

    public const LABEL = [
        'xpert_mtb_rif' => 'Xpert MTB/RIF',
        'xpert_mtb_rif_ultra' => 'Xpert MTB/RIF ULTRA',
        'truenat_tb' => 'Truenat TB',
        'lpa' => 'Line Probe Assay (LPA)',
        'smear_mic' => 'Smear Microscop',
        'tb_lamp' => 'TB Loop-Mediated Isothermal Amplification (TB-LAMP)',
        'tb_culture' => 'TB Culture',
        'dst' => 'Drug Susceptibility Test (DST)',
        'others' => 'Others',
        'dst_from_other_lab' => 'DST from Other Laboratory',
    ];

    protected $fillable = [
        'type',
        'date_collected',
        'name_of_laboratory',
        'result',
    ];

    protected $casts = [
        'date_collected' => 'date',
    ];

    public function getNameAttribute()
    {
        return Str::startsWith($this->type, 'Others') ? $this->type : self::LABEL[$this->type];
    }

    public function getResultAttribute($value)
    {
        if($this->type == 'lpa'){
            return json_decode($value);
        }
        return $value;
    }

}
