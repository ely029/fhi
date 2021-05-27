<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAndFeedbacks extends Model
{
    use HasFactory;

    protected $table = 'report_and_feedbacks';
    protected $fillable = [
        'role_id',
        'user_id',
        'issue',
        'channel',
    ];
}
