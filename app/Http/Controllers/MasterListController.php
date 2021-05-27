<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
            ->join('recommendation as sec_remarks', 'tb_mac_forms.id', 'sec_remarks.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('case_management_regiment_form', 'case_management_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'sec_remarks.recommendation as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'case_management')
            ->where('sec_remarks.role_id', 4)
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['For approval', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->get();
        $treatmentOutcome = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('recommendation as sec_remarks', 'tb_mac_forms.id', 'sec_remarks.form_id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'sec_remarks.recommendation as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'treatment_outcome')
            ->where('sec_remarks.role_id', 4)
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['For approval', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->get();
        $enrollment = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('recommendation as sec_remarks', 'tb_mac_forms.id', 'sec_remarks.form_id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'sec_remarks.recommendation as remarks', 'tb_mac_forms.presentation_number', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'enrollment')
            ->where('sec_remarks.role_id', 4)
            ->whereIn('tb_mac_forms.status', ['Enrolled', 'Not Enrolled'])
            ->whereIn('recommendation.status', ['For enrollment', 'Not for Enrollment', 'Need Further Details', 'Referred to N-TB MAC'])
            ->Where('recommendation.role_id', 6)
            ->where('tb_mac_forms.role_id', 3)
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
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
            ->join('recommendation as sec_remarks', 'tb_mac_forms.id', 'sec_remarks.form_id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'tb_mac_forms.presentation_number', 'sec_remarks.recommendation as remarks', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'case_management')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['For approval', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [$request['date_from'], $request['date_to']])
            ->get();
        $treatmentOutcome = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('recommendation as sec_remarks', 'tb_mac_forms.id', 'sec_remarks.form_id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'tb_mac_forms.presentation_number', 'sec_remarks.recommendation as remarks', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'treatment_outcome')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved'])
            ->whereIn('recommendation.status', ['For approval', 'Other suggestions', 'Need Further Details', 'Referred to N-TB MAC'])
            ->whereBetween('tb_mac_forms.created_at', [$request['date_from'], $request['date_to']])
            ->get();
        $enrollment = DB::table('tb_mac_forms')
            ->join('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('recommendation as sec_remarks', 'tb_mac_forms.id', 'sec_remarks.form_id')
            ->select('tb_mac_forms.id', 'tb_mac_forms.status as header_status', 'tb_mac_forms.presentation_number', 'sec_remarks.recommendation as remarks', 'recommendation.status as recom_status', 'patients.first_name', 'patients.middle_name', 'patients.last_name', 'patients.birthday', 'tb_mac_forms.updated_at', 'patients.gender')
            ->where('tb_mac_forms.form_type', 'enrollment')
            ->Where('recommendation.role_id', 6)
            ->where('tb_mac_forms.role_id', 3)
            ->whereBetween('tb_mac_forms.created_at', [$request['date_from'], $request['date_to']])
            ->get();
        return view('masterlist.index')
            ->with('caseManagement', $caseManagement)
            ->with('enrollment', $enrollment)
            ->with('treatmentOutcome', $treatmentOutcome);
    }
}