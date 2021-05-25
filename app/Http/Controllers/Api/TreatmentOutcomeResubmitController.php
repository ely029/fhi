<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\TBMacForm;
use Illuminate\Support\Facades\Storage;

class TreatmentOutcomeResubmitController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        // if (! in_array($tbMacForm->status, ['Not for Referral','Need Further Details'])) {
        //     return response()->json('Forbidden', 403);
        // }
        $tbMacForm = $tbMacForm->load(['treatmentOutcomeForm','treatmentOutcomeBacteriologicalResults','laboratoryResults','attachments','patient']);

        $bacteriologicalResults = $tbMacForm->treatmentOutcomeBacteriologicalResults;

        $screenings = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'screenings';
        })->map(function ($item, $key) {
            return [
                'label' => 'Screening '.($key + 1),
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'method_used' => $item->method_used,
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->all();

        $lpa = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'lpa';
        })->first();

        $lpa = [
            'date_collected' => $lpa->date_collected->format('m-d-Y'),
            'resistance_pattern' => $lpa->resistance_pattern,
        ];

        $dst = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'dst';
        })->first();

        $dst = [
            'date_collected' => $dst->date_collected->format('m-d-Y'),
            'resistance_pattern' => $dst->resistance_pattern,
            'resistance_pattern_others' => $dst->resistance_pattern_others,
        ];

        $monthlyScreenings = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'monthly_screenings';
        })->values()->map(function ($item, $key) {
            return [
                'label' => $key === 0 ? 'B' : $key,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'smear_microscopy' => $item->smear_microscopy,
                'tb_lamp' => $item->tb_lamp,
                'culture' => $item->culture,
            ];
        });

        $attachments = [];
        foreach ($tbMacForm->attachments as $attachment) {
            $attachments[] = [
                'url' => url('api/treatment-outcomes/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment'),
                'filename' => $attachment->file_name,
            ];
        }

        $data = [];
        $data['tb_case_number'] = $tbMacForm->treatmentOutcomeForm->tb_case_number;
        $data['last_name'] = $tbMacForm->patient->last_name;
        $data['first_name'] = $tbMacForm->patient->first_name;
        $data['middle_name'] = $tbMacForm->patient->middle_name;
        $data['facility_code'] = $tbMacForm->patient->facility_code;
        $data['province'] = $tbMacForm->patient->province;
        $data['birthday'] = $tbMacForm->patient->birthday->format('Y-m-d');
        $data['gender'] = $tbMacForm->patient->gender;
        $data['date_started_treatment'] = $tbMacForm->treatmentOutcomeForm->date_started_treatment->format('Y-m-d');
        $data['current_drug_susceptibility'] = $tbMacForm->treatmentOutcomeForm->current_drug_susceptibility;
        $data['screenings'] = $screenings;
        $data['lpa'] = $lpa;
        $data['dst'] = $dst;
        $data['monthly_screenings'] = $monthlyScreenings;
        $data['cxr_date'] = $tbMacForm->laboratoryResults->cxr_date->format('Y-m-d');
        $data['cxr_reading'] = $tbMacForm->laboratoryResults->cxr_reading;
        $data['cxr_result'] = $tbMacForm->laboratoryResults->cxr_result;
        $data['attachments'] = $attachments;
        $data['outcome'] = $tbMacForm->treatmentOutcomeForm->outcome;
        $data['remarks'] = $tbMacForm->laboratoryResults->remarks;
        return response()->json($data);
    }

    public function reSubmit(TBMacForm $tbMacForm)
    {
        $validator = \Validator::make(request()->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $request = request()->all();

        unset($request['_token']);
        $request['status'] = 'New Case';
        $tbMacForm->patient->update($request);
        $tbMacForm->update($request);

        $tbMacForm->treatmentOutcomeForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        if (isset($request['attachments-to-remove'])) {
            $this->removeAttachments($tbMacForm, $request);
        }

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs('private/treatment-outcomes/'.$tbMacForm->presentation_number, $fileName);
                $tbMacForm->attachments()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                ]);
            }
        }

        $tbMacForm->treatmentOutcomeBacteriologicalResults()->delete();
        $this->createScreenings($request, $tbMacForm);
        $this->createLPADST($request, $tbMacForm);
        $this->createMonthlyScreenings($request, $tbMacForm);

        return response()->json('Treatment outcome resubmitted Successfully');
    }

    protected function rules()
    {
        $storeRequest = new StoreRequest();
        $rules = $storeRequest->rules();
        $rules['monthly_screenings'] = 'required';
        return $rules;
    }

    private function createScreenings($request, $tbMacForm)
    {
        // Screening 1
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'screenings',
            'date_collected' => $request['screening_1_date_collected'],
            'method_used' => $request['screening_1_method_used'],
            'resistance_pattern' => $request['screening_1_resistance_pattern'],
        ]);

        // Screening 2
        if (isset($request['screening_2_date_collected'])) {
            $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
                'type' => 'screenings',
                'date_collected' => $request['screening_2_date_collected'],
                'method_used' => $request['screening_2_method_used'],
                'resistance_pattern' => $request['screening_2_resistance_pattern'],
            ]);
        }
    }

    private function createLPADST($request, $tbMacForm)
    {
        // LPA
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'lpa',
            'date_collected' => $request['lpa_date_collected'],
            'resistance_pattern' => $request['lpa_resistance_pattern'],
        ]);

        // DST
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'dst',
            'date_collected' => $request['dst_date_collected'],
            'resistance_pattern' => $request['dst_resistance_pattern'],
            'resistance_pattern_others' => $request['dst_resistance_pattern'] === 'Other (specify)' ? $request['dst_resistance_pattern_others'] : null,
        ]);
    }

    private function createMonthlyScreenings($request, $tbMacForm)
    {
        foreach (json_decode($request['monthly_screenings']) as $item) {
            $item = (array) $item;
            $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
                'type' => 'monthly_screenings',
                'date_collected' => $item['date_collected'],
                'smear_microscopy' => $item['smear_microscopy'],
                'tb_lamp' => $item['tb_lamp'],
                'culture' => $item['culture'],
            ]);
        }
    }

    private function removeAttachments($tbMacForm, $request)
    {
        foreach (json_decode($request['attachments-to-remove']) as $toRemove) {
            $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$toRemove;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $tbMacForm->attachments()->where('file_name', $toRemove)->delete();
        }
    }
}
