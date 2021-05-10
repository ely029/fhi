<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\Patient;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Str;

class TreatmentOutcomeAttachmentsController extends Controller
{
    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$fileName;
        $notImage = ['.pdf','.xls','.xlsx','.csv','.docx'];
        if (\Storage::exists($path)) {
            if (Str::endsWith($fileName, $notImage)) {
                return response()->file(public_path('assets/app/img/icon-upload.png'));
            }
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }
        return response()->file(public_path('assets/app/img/placeholder.jpg'));
    }

    public function downloadAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$fileName;
        if (\Storage::exists($path)) {
            return \Storage::download($path, $fileName);
        }
    }
}
