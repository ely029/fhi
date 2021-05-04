<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CaseManagementAttachments
 *
 * @property int $id
 * @property int $form_id
 * @property string|null $file_name
 * @property string $extension
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseManagementAttachments whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CaseManagementAttachments extends Model
{
    use HasFactory;

    public const PATH_PREFIX = 'private/case-management';

    protected $table = 'case_management_attachments';
    protected $fillable = [
        'file_name',
        'form_id',
        'extension',
    ];

    public function createAttachment($request, $form)
    {
        foreach ($request['attachments'] as $key => $file) {
            $fileName = $file->getClientOriginalName();
            $file->storeAs(CaseManagementAttachments::PATH_PREFIX.'/'.$form->presentation_number, $fileName);
            $form->caseManagementAttachment()->create([
                'file_name' => $fileName,
                'extension' => $file->extension(),
                'form_id' => $form->id,
            ]);
        }
    }

    public function createAttachmentMobile($request, $form)
    {
            $file = $request['attachments'];
            $fileName = $file->getClientOriginalName();
            $file->storeAs(CaseManagementAttachments::PATH_PREFIX.'/'.$form->presentation_number, $fileName);
            $form->caseManagementAttachment()->create([
                'file_name' => $fileName,
                'extension' => $file->extension(),
                'form_id' => $form->id,
            ]);
    }
}
