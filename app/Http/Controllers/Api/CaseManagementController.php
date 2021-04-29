<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Filters\TBMacFormFilters;
use App\Models\TBMacForm;
use Illuminate\Http\Request;

class CaseManagementController extends Controller
{
    public function index(TBMacFormFilters $tBMacFormFilters)
    {
        $caseManagement = TBMacForm::caseManagementForms()
            ->with('patient', 'caseManagementForm')
            ->filter($tBMacFormFilters)
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderBy('created_at')->paginate(10);

        $data = $caseManagement->map(function ($item) {
            return [
                'id' => $item->id,
                'patient_code' => $item->patient->code,
                'date_created' => $item->created_at->format('Y-m-d'),
                'facility_code' => $item->patient->facility_code,
                'status' => $item->status,
                'drug_susceptibility' => $item->caseManagementForm->current_drug_susceptibility === '' ? 'null' : $item->caseManagementForm->current_drug_susceptibility,
            ];
        });

        return response()->json($data);
    }

    private function getDynamicQuery()
    {
        $condition = 'submitted_by';
        $value = auth()->user()->id;

        if (in_array(auth()->user()->role_id, [4,5,6])) {
            $condition = 'region';
            // change to auth user region
            $value = 'NCR';
        } elseif (in_array(auth()->user()->role_id, [7,8])) {
            $condition = 'form_type';
            $value = 'enrollment';
        }

        return [
            'condition' => $condition,
            'value' => $value,
        ];
    }
}
