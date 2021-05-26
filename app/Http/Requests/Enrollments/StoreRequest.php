<?php

declare(strict_types=1);

namespace App\Http\Requests\Enrollments;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'facility_code' => 'required|numeric|digits_between:1,10000000',
            'province' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'middle_name' => 'required|max:255',
            'birthday' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:Male,Female',
            'treatment_history' => 'required|max:1000',
            'registration_group' => 'required',
            'risk_factor' => 'required',
            'drug_susceptibility' => 'required',
            'current_weight' => 'required|numeric|digits_between:1,500',
            'suggested_regimen' => 'required',
            'itr_drugs' => 'nullable|required_if:suggested_regimen,ITR',
            'suggested_regimen_others' => 'nullable|required_if:suggested_regimen,Other (specify)',
            'regimen_notes' => 'required|max:1000',
            'clinical_status' => 'required|max:1000',
            'signs_and_symptoms' => 'required|max:255',
            'vital_signs' => 'required|max:255',
            'diag_and_lab_findings' => 'required|max:255',
            'cxr_date' => 'nullable|date_format:Y-m-d',
            'cxr_result' => 'nullable|max:255',
            'cxr_reading.*' => 'nullable',
            'ct_scan_date' => 'nullable|date_format:Y-m-d',
            'ct_scan_result' => 'nullable|max:255',
            'ultrasound_date' => 'nullable|date_format:Y-m-d',
            'ultrasound_result' => 'nullable|max:255',
            'histopathological_date' => 'nullable|date_format:Y-m-d',
            'histopathological_result' => 'nullable|max:255',
            'remarks' => 'required|max:1000',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,svg,pdf|max:10000',
        ];
    }
}
