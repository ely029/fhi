<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geolocation
 *
 * @property string $id
 * @property int|null $oldID
 * @property string|null $etrID
 * @property string|null $code
 * @property string $name1
 * @property int|null $unitsCount
 * @property int|null $levelID
 * @property int|null $glocation_level_id
 * @property int|null $arrangement
 * @property int|null $oldPARENT_ID
 * @property string|null $PARENT_ID
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation regions()
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereArrangement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereEtrID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereGlocationLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereLevelID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereName1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereOldID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereOldPARENTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation wherePARENTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geolocation whereUnitsCount($value)
 * @mixin \Eloquent
 */
class Geolocation extends Model
{
    protected $table = 'glocations';
    protected $keyType = 'string';

    public function scopeRegions($query)
    {
        return $query->where('glocation_level_id', 1);
    }
}
