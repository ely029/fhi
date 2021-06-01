<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CaseManagementRegimentForm;
use App\Models\EnrollmentRegimentForm;
use App\Models\TreatmentOutcomeForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MasterListController extends Controller
{
    public function index()
    {
        $firstDay = Carbon::now()->firstOfMonth()->format('Y-m-d');
        $lastDay = Carbon::now()->lastOfMonth()->format('Y-m-d');
        $caseManagement = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('case_management_regiment_form', 'case_management_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'case_management_regiment_form.sec_remarks as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'case_management')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['Approved', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $treatmentOutcome = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('treatment_outcome_form', 'treatment_outcome_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'treatment_outcome_form.sec_remarks as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'treatment_outcome')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['Approved', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $enrollment = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('enrollment_regiment_form', 'enrollment_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'enrollment_regiment_form.sec_remarks as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'enrollment')
            ->whereIn('tb_mac_forms.status', ['Enrolled', 'Not Enrolled'])
            ->whereIn('recommendation.status', ['For enrollment', 'Not for Enrollment', 'Need Further Details', 'Referred to N-TB MAC'])
            ->Where('recommendation.role_id', 6)
            ->where('tb_mac_forms.role_id', 3)
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->orderBy('tb_mac_forms.id', 'asc')
            ->get();
        return view('masterlist.index')
            ->with('caseManagement', $caseManagement)
            ->with('enrollment', $enrollment)
            ->with('treatmentOutcome', $treatmentOutcome);
    }

    public function filter()
    {
        $request = request()->all();
        $caseManagement = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('case_management_regiment_form', 'case_management_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'case_management_regiment_form.sec_remarks as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'case_management')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['Approved', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [date('Y-m-d', strtotime($request['date_from'])) ?? null, date('Y-m-d', strtotime($request['date_to'])) ?? null])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $treatmentOutcome = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('treatment_outcome_form', 'treatment_outcome_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'treatment_outcome_form.sec_remarks as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'treatment_outcome')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['Approved', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [date('Y-m-d', strtotime($request['date_from'])) ?? null, date('Y-m-d', strtotime($request['date_to'])) ?? null])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $enrollment = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('enrollment_regiment_form', 'enrollment_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'enrollment_regiment_form.sec_remarks as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'enrollment')
            ->whereIn('tb_mac_forms.status', ['Enrolled', 'Not Enrolled'])
            ->whereIn('recommendation.status', ['For enrollment', 'Not for Enrollment', 'Need Further Details', 'Referred to N-TB MAC'])
            ->Where('recommendation.role_id', 6)
            ->where('tb_mac_forms.role_id', 3)
            ->whereBetween('tb_mac_forms.created_at', [date('Y-m-d', strtotime($request['date_from'])) ?? null, date('Y-m-d', strtotime($request['date_to'])) ?? null])
            ->orderBy('tb_mac_forms.id', 'asc')
            ->get();
        return view('masterlist.index')
            ->with('caseManagement', $caseManagement)
            ->with('enrollment', $enrollment)
            ->with('treatmentOutcome', $treatmentOutcome);
    }

    public function updateRemarks()
    {
        $request = request()->all();
        if ($request['form_type'] === 'enrollment') {
            EnrollmentRegimentForm::where('form_id', $request['form_id'])->update([
                'sec_remarks' => $request['remarks'],
            ]);
        }

        if ($request['form_type'] === 'case_management') {
            CaseManagementRegimentForm::where('form_id', $request['form_id'])->update([
                'sec_remarks' => $request['remarks'],
            ]);
        }

        if ($request['form_type'] === 'treatment_outcome') {
            TreatmentOutcomeForm::where('form_id', $request['form_id'])->update([
                'sec_remarks' => $request['remarks'],
            ]);
        }

        return redirect()->back();
    }
}
