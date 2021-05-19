<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;
use Illuminate\Support\Str;

class TreatmentOutcomeAttachmentsController extends Controller
{
    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$fileName;
        if (\Storage::exists($path)) {
            if (Str::endsWith($fileName, '.xls') || Str::endsWith($fileName, '.xlsx') || Str::endsWith($fileName, '.csv')) {
                return response()->file(public_path('assets/app/img/excel.png'));
            }
            if (Str::endsWith($fileName, '.pdf')) {
                return response()->file(public_path('assets/app/img/pdf.png'));
            }
            if (Str::endsWith($fileName, '.docx')) {
                return response()->file(public_path('assets/app/img/docx.png'));
            }
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }
    }

    public function downloadAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$fileName;
        if (\Storage::exists($path)) {
            return \Storage::download($path, $fileName);
        }
    }
}
