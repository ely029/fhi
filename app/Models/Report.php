<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'prepared_by',
        'period',
        'year',
        'quarter',
        'month',
        'region',
        'province',
        'health_facility',
        'remarks',
        'report_data',
    ];

    protected $casts = [
        'report_data' => 'array',
    ];

    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $max = Report::count();
            $reportNumber = 'Report-'.str_pad(strval($max), 4, '0', STR_PAD_LEFT);
            $model->report_number = $reportNumber;
            $model->save();
        });
    }
}
