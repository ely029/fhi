<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Filters\TBMacFormFilters;
use App\Http\Controllers\Controller;
use App\Models\BacteriologicalResult;
use App\Models\Patient;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Str;

class EnrollmentsController extends Controller
{
    public function index(TBMacFormFilters $filters)
    {
        $enrollments = TBMacForm::EnrollmentForms()
            ->filter($filters)
            ->with(['patient','enrollmentForm'])
            ->where('submitted_by', auth()->user()->id)
            ->orderByDesc('created_at')->paginate(10);
        
        $data = $enrollments->map(function($item){
                return [
                    'id' => $item->id,
                    'patient_code' => $item->patient->code,
                    'date_created' => $item->created_at->format('M d, Y'),
                    'facility_code' => $item->patient->facility_code,
                    'status' => $item->status,
                    'drug_susceptibility' => $item->enrollmentForm->drug_susceptibility,
                ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function store()
    {
        $validator = \Validator::make(request()->all(),$this->rules());

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors(),
            ],422);
        }

        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'enrollment';
        $request['status'] = 'New Enrollment';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';
        $request['is_from_itis'] = false;


        $patient = Patient::create($request);
        
        $request['patient_id'] = $patient->id;
        $tbMacForm = TBMacForm::create($request);

        $tbMacForm->enrollmentForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);


        if (isset($request['attachments'])) {
            foreach($request['attachments'] as $key => $file)
            {
                $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, ($key+1).'.'.$file->extension());   
                $tbMacForm->attachments()->create([
                    'extension' => $file->extension()
                ]);
            }
        }


        foreach (BacteriologicalResult::LABEL as $status => $label)
        {
            if (isset($request[$status])) {

                foreach (json_decode($request[$status]) as $item)
                {
                    $item = (array) $item;

                    $tbMacForm->bacteriologicalResults()->create([
                        'type' => $status == 'others' ? 'Others-'.$item['specify'] : $status,
                        'date_collected' => $item['date_collected'],
                        'name_of_laboratory' => $item['name_of_laboratory'],
                        'result' => $status == 'lpa' ? json_encode($item['result']) : $item['result'],
                    ]);
                } 
            }
        }

        return response()->json('Enrollment form submitted successfully');

    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments','patient']);
        $tbBacteriologicalResults = $tbMacForm->bacteriologicalResults;
        $bacteriologicalResults = $tbBacteriologicalResults->filter(function($item){
                return $item->type != 'dst_from_other_lab';
        })->map(function($item){
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('d F Y'),
                'result' => $item->result
            ];
        })->values();

        $dstFromOtherLab = $tbBacteriologicalResults->filter(function($item){
            return $item->type == 'dst_from_other_lab';
        })->map(function($item){
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('d F Y'),
                'result' => $item->result
            ];
        })->values();

        $attachments = [];
        foreach($tbMacForm->attachments as $key => $attachment)
        {
            $fileName = ($key+1).'.'.$attachment->extension;
            $attachments[] = [
                'url' => url('api/enrollments/'.$tbMacForm->id.'/'.$fileName.'/attachment') 
            ];
        }

        $data = [
            'date_created' => $tbMacForm->created_at->format('M d, Y'),
            'patient_code' => $tbMacForm->patient->code,
            'facility_code' => $tbMacForm->patient->facility_code,
            'status' => $tbMacForm->status,
            'date_submitted_to_rtb_mac' => '',
            'treatment_history' => $tbMacForm->enrollmentForm->treatment_history,
            'registration_group' => $tbMacForm->enrollmentForm->registration_group,
            'risk_factor' => $tbMacForm->enrollmentForm->risk_factor,
            'bacteriological_results' => $bacteriologicalResults,
            'dst_from_other_lab' => $dstFromOtherLab,
            'drug_susceptibility' => $tbMacForm->enrollmentForm->drug_susceptibility,
            'current_weight' => $tbMacForm->enrollmentForm->current_weight,
            'suggested_regimen' => $tbMacForm->enrollmentForm->suggested_regimen,
            'itr_drugs' => Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen,'ITR') ? $tbMacForm->enrollmentForm->suggested_regimen : null,
            'regiment_notes' => $tbMacForm->enrollmentForm->regimen_notes,
            'clinical_status' => $tbMacForm->enrollmentForm->clinical_status,
            'vital_signs' => $tbMacForm->enrollmentForm->vital_signs,
            'diag_and_lab_findings' => $tbMacForm->enrollmentForm->diag_and_lab_findings,
            'signs_and_symptoms' => $tbMacForm->enrollmentForm->signs_and_symptoms,
            'cxr_date' => $tbMacForm->laboratoryResults->cxr_date ? $tbMacForm->laboratoryResults->cxr_date->format('m/d/y') : '',
            'cxr_result' => $tbMacForm->laboratoryResults->cxr_result,
            'cxr_reading' => $tbMacForm->laboratoryResults->cxr_reading,
            'ct_scan_date' => $tbMacForm->laboratoryResults->ct_scan_date ? $tbMacForm->laboratoryResults->ct_scan_date->format('m/d/y') : '',
            'ct_scan_result' => $tbMacForm->laboratoryResults->ct_scan_result,
            'ultrasound_date' => $tbMacForm->laboratoryResults->ultrasound_date ? $tbMacForm->laboratoryResults->ultrasound_date->format('m/d/y') : '',
            'ultrasound_result' => $tbMacForm->laboratoryResults->ultrasound_result,
            'histopathological_date' => $tbMacForm->laboratoryResults->hispathological_date ? $tbMacForm->laboratoryResults->hispathological_date->format('m/d/y') : '',
            'histopathological_result' => $tbMacForm->laboratoryResults->hispathological_result,
            'remarks' => $tbMacForm->laboratoryResults->remarks,
            'attachments' => $attachments,
        ];

        return response()->json($data);
    }

    protected function rules()
    {
        return [
            'facility_code' => 'required',
            'province' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'birthday' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:Male,Female',
            'treatment_history' => 'required',
            'registration_group' => 'required',
            'risk_factor' => 'required',
            'drug_susceptibility' => 'required',
            'current_weight' => 'required|numeric',
            'suggested_regimen' => 'required',
            'itr_drugs' => 'nullable|required_if:suggested_regimen,ITR',
            'suggested_regimen_others' => 'nullable|required_if:suggested_regimen,Other (specify)',
            'regimen_notes' => 'required',
            'clinical_status' => 'required',
            'signs_and_symptoms' => 'required',
            'vital_signs' => 'required',
            'diag_and_lab_findings' => 'required',
            'cxr_date' => 'nullable|date_format:Y-m-d',
            'cxr_result' => 'nullable',
            'cxr_reading.*' => 'nullable',
            'ct_scan_date' => 'nullable|date_format:Y-m-d',
            'ct_scan_result' => 'nullable',
            'ultrasound_date' => 'nullable|date_format:Y-m-d',
            'ultrasound_result' => 'nullable',
            'histopathological_date' => 'nullable|date_format:Y-m-d',
            'histopathological_result' => 'nullable',
            'remarks' => 'required',
            'attachments.*' => 'nullable|image|max:10000'
        ];
    }

    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$fileName;

        if (\Storage::exists($path)) {
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }else{
            abort(404, "File does not exist!");
        }
    }
}