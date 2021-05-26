<?php

declare(strict_types=1);

namespace App\Http\Requests\TreatmentOutcomes;

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
            'tb_case_number' => 'required|numeric',
            'facility_code' => 'required|numeric|digits_between:1,10000000',
            'province' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'middle_name' => 'required|max:255',
            'birthday' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:Male,Female',
            'date_started_treatment' => 'required|date_format:Y-m-d',
            'current_drug_susceptibility' => 'required',
            'cxr_date' => 'required|date_format:Y-m-d',
            'cxr_result' => 'required|max:255',
            'cxr_reading' => 'required|in:Improved,Stable/Unchanged,Worsened',
            'ct_scan_date' => 'nullable|date_format:Y-m-d',
            'ct_scan_result' => 'nullable|max:255',
            'ultrasound_date' => 'nullable|date_format:Y-m-d',
            'ultrasound_result' => 'nullable|max:255',
            'histopathological_date' => 'nullable|date_format:Y-m-d',
            'histopathological_result' => 'nullable|max:255',
            'remarks' => 'required|max:1000',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,svg,pdf|max:10000',
            'outcome' => 'required|in:Cured,Treatment Completed,Failed,Lost to Follow-up,Died,Excluded',
            'screening_1_date_collected' => 'required|date_format:Y-m-d',
            'screening_1_method_used' => 'required|in:Xpert MTB/RIF,Xpert MTB/RIF ULTRA,Truenat TB',
            'screening_1_resistance_pattern' => 'required',
            'lpa_date_collected' => 'required|date_format:Y-m-d',
            'lpa_resistance_pattern' => 'required',
            'dst_date_collected' => 'required|date_format:Y-m-d',
            'dst_resistance_pattern' => 'required',
            'dst_resistance_pattern_others' => 'required_if:dst_resistance_pattern,Other (specify)',
        ];
    }
}
