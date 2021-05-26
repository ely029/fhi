<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\MediaAttachment;

class TreatmentOutcomeAttachmentsController extends Controller
{
    use MediaAttachment;

    // public function downloadAttachment(TBMacForm $tbMacForm, $fileName)
    // {
    //     $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$fileName;
    //     if (\Storage::exists($path)) {
    //         return \Storage::download($path, $fileName);
    //     }
    // }
}
