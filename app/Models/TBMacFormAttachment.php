<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TBMacFormAttachment
 *
 * @property int $id
 * @property int $form_id
 * @property string $extension
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $file_name
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TBMacFormAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TBMacFormAttachment extends Model
{
    public const PATH_PREFIX = 'private/enrollments';

    protected $table = 'tb_mac_form_attachments';

    protected $fillable = [
        'extension', 'file_name',
    ];
}
