<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Enrollments\StoreRequest;
use App\Models\BacteriologicalResult;
use App\Models\Geolocation;
use App\Models\Patient;
use App\Models\Recommendation;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use App\Traits\MediaAttachment;

class EnrollmentRegimentController extends Controller
{
    use MediaAttachment;

    public function index()
    {
        $enrollments = TBMacForm::EnrollmentForms()
            ->with(['patient','enrollmentForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->get();

        switch (auth()->user()->role_id) {
            case 3:
                return $this->getHealthCareWorkerIndex($enrollments);
            case 4:
                return $this->getRegionalSecretariatIndex($enrollments);
            case 5:
                return $this->getRegionalTBMacIndex($enrollments);
            case 6:
                return $this->getRegionalTBMacChairIndex($enrollments);
            case 7:
                return $this->getNationalTBMacIndex($enrollments);
            case 8:
                return $this->getNationalTBMacChairIndex($enrollments);
        }
    }

    public function create()
    {
        $region = Geolocation::where('name1', auth()->user()->region)->first();
        $provinces = Geolocation::where('PARENT_ID', ($region === null ? 'NCR' : $region->id))->pluck('name1', 'id');
        return view('enrollments.form')
            ->with('provinces', count($provinces) > 1 ? $provinces : ['Metro Manila']);
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','attachments', 'patient']);

        return view('enrollments.show')
            ->with('tbMacForm', $tbMacForm);
    }

    public function store(StoreRequest $request)
    {
        $request = $request->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'enrollment';
        $request['status'] = 'New Enrollment';
        $request['role_id'] = 4;
        $request['region'] = auth()->user()->region ?? 'NCR';
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;

        $patient = Patient::create($request);

        $request['patient_id'] = $patient->id;
        $tbMacForm = TBMacForm::create($request);

        $tbMacForm->enrollmentForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        if (isset($request['attachments'])) {
            $this->uploadAttachment($request, $tbMacForm);
        }

        foreach (BacteriologicalResult::LABEL as $status => $label) {
            if (isset($request[$status])) {
                $this->createBacteriologicalStatus($request, $tbMacForm, $status);
            }
        }

        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['status'] = 'New Enrollment';
        $request['recommendation'] = 'new enrollment';
        $request['form_id'] = $tbMacForm->id;
        Recommendation::create($request);

        return redirect('enrollments/'.$tbMacForm->id)->with([
            'alert.message' => 'New case for enrollment created.',
        ]);
    }
    public function sendRecommendation()
    {
        $request = request()->all();
        if (auth()->user()->role_id === 3) {
            return $this->healthWorkerRecommendation($request);
        }
        if (auth()->user()->role_id === 4) {
            return $this->secretariatRecommendation($request);
        }

        if (auth()->user()->role_id === 5) {
            return $this->regionalRecommendations($request);
        }

        if (auth()->user()->role_id === 6) {
            return $this->regionalChairRecommendation($request);
        }

        if (auth()->user()->role_id === 7) {
            return $this->ntbMacRecommendation($request);
        }

        if (auth()->user()->role_id === 8) {
            return $this->ntbMacChairRecommendation($request);
        }
    }

    // public function downloadAttachment(TBMacForm $tbMacForm, $fileName)
    // {
    //     $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$fileName;
    //     if (\Storage::exists($path)) {
    //         return \Storage::download($path, $fileName);
    //     }
    // }

    private function uploadAttachment($request, $tbMacForm)
    {
        foreach ($request['attachments'] as $key => $file) {
            if (! in_array($file->extension(), ['jpg','jpeg','pdf','JPG','JPEG','png','PNG'])) {
                continue;
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, $fileName);
            $tbMacForm->attachments()->create([
                'file_name' => $fileName,
                'extension' => $file->extension(),
            ]);
        }
    }
    private function healthWorkerRecommendation($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        if ($request['status'] === 'Enrolled') {
            $tbMacForm->status = $request['status'];
            $tbMacForm->role_id = auth()->user()->role_id;
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        } else {
            $tbMacForm->status = $request['status'];
            $tbMacForm->role_id = auth()->user()->role_id;
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }

        return redirect('enrollments')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }
    private function ntbMacChairRecommendation($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Referred back to regional chair';
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        Recommendation::create($request);

        return redirect('enrollments')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }

    private function ntbMacRecommendation($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Referred to national chair';
        $tbMacForm->role_id = auth()->user()->role_id;
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['status'] = 'Referred to national chair';
        Recommendation::create($request);

        return redirect('enrollments')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }

    private function secretariatRecommendation($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        if (in_array($request['status'], ['Not For Referral','Need Further Details'])) {
            $tbMacForm->status = $request['status'];
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        } else {
            $tbMacForm->status = 'Referred to Regional';
            $tbMacForm->role_id = auth()->user()->role_id;
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }

        return redirect('enrollments')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }

    private function createBacteriologicalStatus($request, $tbMacForm, $status)
    {
        foreach ($request[$status] as $key => $type) {
            $tbMacForm->bacteriologicalResults()->create([
                'type' => $status === 'others' ? 'Others-'.$request['others-specify'][$key] : $type,
                'date_collected' => $request[$type.'-date_collected'][$key],
                'name_of_laboratory' => $request[$type.'-name_of_laboratory'][$key],
                'result' => $type === 'lpa' ? json_encode($request[$type.'-'.$key.'-result']) : $request[$type.'-result'][$key],
            ]);
        }
    }

    private function regionalRecommendations($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Referred to regional chair';
        $tbMacForm->save();
        // if ($request['status'] === 'Not for Referral' || $request['status'] === 'Need Further Details' || $request['status'] === 'Not For Enrollment' || $request['status'] === 'For Enrollment') {
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        Recommendation::create($request);

        return redirect('enrollments')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
        // }
    }

    private function regionalChairRecommendation($request)
    {
        // if ($request['status'] === 'For Enrollment') {
        //     $tbMacForm = TBMacForm::find($request['form_id']);
        //     $tbMacForm->status = $request['status'];
        //     $tbMacForm->role_id = auth()->user()->role_id;
        //     $tbMacForm->save();
        //     $request['submitted_by'] = auth()->user()->id;
        //     $request['role_id'] = auth()->user()->role_id;
        //     Recommendation::create($request);
        // }
        // if ($request['status'] === 'Not For Enrollment') {
        //     $tbMacForm = TBMacForm::find($request['form_id']);
        //     $tbMacForm->status = $request['status'];
        //     $tbMacForm->role_id = auth()->user()->role_id;
        //     $tbMacForm->save();
        //     $request['submitted_by'] = auth()->user()->id;
        //     $request['role_id'] = auth()->user()->role_id;
        //     Recommendation::create($request);
        // }
        // if ($request['status'] === 'Need Further Details') {
        //     $tbMacForm = TBMacForm::find($request['form_id']);
        //     $tbMacForm->status = $request['status'];
        //     $tbMacForm->role_id = auth()->user()->role_id;
        //     $tbMacForm->save();
        //     $request['submitted_by'] = auth()->user()->id;
        //     $request['role_id'] = auth()->user()->role_id;
        //     Recommendation::create($request);
        // }
        // if ($request['status'] === 'Referred to N-TB MAC') {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = $request['status'];
        $tbMacForm->role_id = auth()->user()->role_id;
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        Recommendation::create($request);
        // }

        return redirect('enrollments')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }

    private function getDynamicQuery()
    {
        $condition = 'submitted_by';
        $value = auth()->user()->id;

        if (in_array(auth()->user()->role_id, [4,5,6])) {
            $condition = 'region';
            // change to auth user region
            $value = auth()->user()->region ?? 'NCR';
        } elseif (in_array(auth()->user()->role_id, [7,8])) {
            $condition = 'form_type';
            $value = 'enrollment';
        }

        return [
            'condition' => $condition,
            'value' => $value,
        ];
    }

    private function getHealthCareWorkerIndex($enrollments)
    {
        $forEnrollments = $enrollments->filter(function ($item) {
            return $item->status === 'For Enrollment';
        });

        $notForEnrollments = $enrollments->filter(function ($item) {
            return $item->status === 'Not For Enrollment';
        });

        $needFurtherDetails = $enrollments->filter(function ($item) {
            return $item->status === 'Need Further Details';
        });

        $notForReferrals = $enrollments->filter(function ($item) {
            return $item->status === 'Not For Referral';
        });

        return view('enrollments.index')
            ->with('enrollments', $enrollments)
            ->with('forEnrollments', $forEnrollments)
            ->with('notForEnrollments', $notForEnrollments)
            ->with('needFurtherDetails', $needFurtherDetails)
            ->with('notForReferrals', $notForReferrals);
    }

    private function getRegionalSecretariatIndex($enrollments)
    {
        $pending = $enrollments->filter(function ($item) {
            return $item->status === 'New Enrollment';
        });

        return view('enrollments.index')
            ->with('pending', $pending)
            ->with('allEnrollment', $enrollments);
    }

    private function getRegionalTBMacIndex($enrollments)
    {
        $pending = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to Regional';
        });

        $withRecommendations = $enrollments->filter(function ($item) {
            return in_array($item->status, ['For Enrollment','Not For Enrollment','Need Further Details','Referred to national']);
        });

        $completed = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to regional chair';
        });

        return view('enrollments.index')
            ->with('pending', $pending)
            ->with('withRecommendations', $withRecommendations)
            ->with('completed', $completed)
            ->with('allEnrollments', $enrollments);
    }

    private function getRegionalTBMacChairIndex($enrollments)
    {
        $referred = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to regional chair';
        });

        $pendingFromNTBMacChair = $enrollments->filter(function ($item) {
            return $item->status === 'Referred back to regional chair';
        });

        $completed = $enrollments->filter(function ($item) {
            return in_array($item->status, ['For Enrollment','Not For Enrollment','Need Further Details']);
        });

        $referredToRegional = $enrollments->filter(function ($item) {
            return $item->status === 'Referred To Regional';
        });

        return view('enrollments.index')
            ->with('referred', $referred)
            ->with('pendingFromNTBMacChair', $pendingFromNTBMacChair)
            ->with('completed', $completed)
            ->with('referredToRegional', $referredToRegional)
            ->with('allEnrollments', $enrollments);
    }

    private function getNationalTBMacIndex($enrollments)
    {
        $referred = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to national';
        });

        $completed = $enrollments->filter(function ($item) {
            return in_array($item->status, ['Referred to national chair']);
        });

        $allEnrollments = $enrollments->filter(function ($item) {
            return in_array($item->status, ['For Enrollment','Not For Enrollment','Need Further Details','Referred to regional chair']);
        });

        return view('enrollments.index')
            ->with('referred', $referred)
            ->with('completed', $completed)
            ->with('allEnrollments', $allEnrollments);
    }

    private function getNationalTBMacChairIndex($enrollments)
    {
        $pending = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to national chair';
        });

        $completed = $enrollments->filter(function ($item) {
            return in_array($item->status, ['Referred back to regional chair']);
        });

        $allEnrollments = $enrollments->filter(function ($item) {
            return in_array($item->status, ['For Enrollment','Not For Enrollment','Need Further Details','Referred to regional chair']);
        });

        return view('enrollments.index')
            ->with('pending', $pending)
            ->with('completed', $completed)
            ->with('allEnrollments', $allEnrollments);
    }
}
