<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TBMacFormAttachment extends Model
{

    public const PATH_PREFIX = 'private/enrollments';

    protected $table = 'tb_mac_form_attachments';

    protected $fillable = [
        'extension',
    ];

    
}
