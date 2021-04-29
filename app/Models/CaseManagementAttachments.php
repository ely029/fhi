<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseManagementAttachments extends Model
{
    use HasFactory;

    public const PATH_PREFIX = 'private/enrollments';

    protected $table = 'case_management_attachments';
    protected $fillable = [
        'file_name',
        'form_id',
        'extension',
    ];
}
