<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacteriologicalResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date_collected',
        'name_of_laboratory',
        'result'
    ];
}
