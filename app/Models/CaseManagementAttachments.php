<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            ]);
        }
    }
}
