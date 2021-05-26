<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\TBMacForm;
use Illuminate\Support\Str;

trait MediaAttachment
{
    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $storagePath = $this->storagePath()[$tbMacForm->form_type];
        $path = $storagePath.'/'.$tbMacForm->presentation_number.'/'.$fileName;
        if (\Storage::exists($path)) {
            if (Str::endsWith($fileName, '.pdf')) {
                return response(\Storage::get($path))->header('Content-Type', 'application/pdf');
            }
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }
    }

    private function storagePath()
    {
        return [
            'enrollment' => 'private/enrollments',
            'case_management' => 'private/case-management',
            'treatment_outcome' => 'private/treatment-outcomes',
        ];
    }
}
