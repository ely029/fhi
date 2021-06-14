<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseManagementRegimentForm;
use App\Models\EnrollmentRegimentForm;
use App\Models\TreatmentOutcomeForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MasterlistController extends Controller
{
    public function index()
    {
        $firstDay = Carbon::now()->firstOfMonth()->format('Y-m-d');
        $lastDay = Carbon::now()->lastOfMonth()->format('Y-m-d');
        $caseManagement = DB::table('tb_mac_forms')
            ->leftJoin('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('case_management_regiment_form', 'case_management_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', DB::raw('"case_management" as form_type'), DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'New Case' THEN tb_mac_forms.status ELSE null END) as status"), 'case_management_regiment_form.sec_remarks as remarks', DB::raw('concat("C-",tb_mac_forms.presentation_number) as presentation_number'), DB::raw('(CASE WHEN recommendation.status = "Approved" then recommendation.status WHEN recommendation.status = "Other suggestions" then recommendation.status WHEN recommendation.status = "Need Further Details" then recommendation.status WHEN recommendation.status = "Referred to Regional" then recommendation.status else null END) as recommendation'), DB::raw('SUBSTR(patients.first_name, 0, 1) as patients_fname '), DB::raw('SUBSTR(patients.middle_name, 1, 1) as patients_mname'), DB::raw('SUBSTR(patients.last_name, 1, 1) as patients_lname'), DB::raw('TIMESTAMPDIFF(YEAR, patients.birthday,CURDATE()) as age'), DB::raw("(CASE  WHEN tb_mac_forms.status = 'Not Resolved' THEN DATE_FORMAT(tb_mac_forms.updated_at, '%m/%d/%Y') WHEN tb_mac_forms.status = 'Resolved' THEN DATE_FORMAT(tb_mac_forms.updated_at, '%m/%d/%Y') ELSE null END) as date_resolved"), DB::raw('SUBSTR(patients.gender,1,1) as gender'))
            ->where('tb_mac_forms.form_type', 'case_management')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved', 'New Case'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $treatmentOutcome = DB::table('tb_mac_forms')
            ->leftJoin('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('treatment_outcome_form', 'treatment_outcome_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', DB::raw('"treatment_outcome" as form_type'),
                DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'New Case' THEN tb_mac_forms.status ELSE null END) as status"), 'treatment_outcome_form.sec_remarks as remarks',
                DB::raw('concat("T-",tb_mac_forms.presentation_number) as presentation_number'),
                DB::raw('(CASE WHEN recommendation.status = "Approved" then recommendation.status WHEN recommendation.status = "Other suggestions" then recommendation.status WHEN recommendation.status = "Need Further Details" then recommendation.status WHEN recommendation.status = "Referred to Regional" then recommendation.status else null END) as recommendation'),
                DB::raw('SUBSTR(patients.first_name, 0, 1) as patients_fname '),
                DB::raw('SUBSTR(patients.middle_name, 1, 1) as patients_mname'),
                DB::raw('SUBSTR(patients.last_name, 1, 1) as patients_lname'),
                DB::raw('TIMESTAMPDIFF(YEAR, patients.birthday,CURDATE()) as age'),
                DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN DATE_FORMAT(tb_mac_forms.updated_at, '%m/%d/%Y') WHEN tb_mac_forms.status = 'Resolved' THEN DATE_FORMAT(tb_mac_forms.updated_at, '%m/%d/%Y') ELSE null END) as date_resolved"),
                DB::raw('SUBSTR(patients.gender,1,1) as gender'))
            ->where('tb_mac_forms.form_type', 'treatment_outcome')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved', 'New Case'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $enrollment = DB::table('tb_mac_forms')
            ->leftJoin('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->leftJoin('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->leftJoin('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->leftJoin('enrollment_regiment_form', 'enrollment_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', DB::raw('"enrollment" as form_type'), DB::raw("(CASE
            WHEN tb_mac_forms.status = 'Not Enrolled' THEN tb_mac_forms.status
            WHEN tb_mac_forms.status = 'Enrolled' THEN tb_mac_forms.status
            WHEN tb_mac_forms.status = 'New Enrollment' THEN tb_mac_forms.status
            ELSE null END) as status"), 'enrollment_regiment_form.sec_remarks as remarks', DB::raw('concat("E-",tb_mac_forms.presentation_number) as presentation_number'), DB::raw('(CASE WHEN recommendation.status = "For enrollment" then recommendation.status WHEN recommendation.status = "Not for Enrollment" then recommendation.status WHEN recommendation.status = "Need Further Details" then recommendation.status WHEN recommendation.status = "Referred to nationa;" then recommendation.status else null END) as recommendation'), DB::raw('SUBSTR(patients.first_name, 1, 1) as patients_fname '), DB::raw('SUBSTR(patients.middle_name, 1, 1) as patients_mname'), DB::raw('SUBSTR(patients.last_name, 1, 1) as patients_lname'), DB::raw('TIMESTAMPDIFF(YEAR, patients.birthday,CURDATE()) as age'), DB::raw("(CASE
                WHEN tb_mac_forms.status = 'Not Resolved' THEN DATE_FORMAT(tb_mac_forms.updated_at, '%m/%d/%Y')
                WHEN tb_mac_forms.status = 'Resolved' THEN DATE_FORMAT(tb_mac_forms.updated_at, '%m/%d/%Y')
                ELSE null END) as date_resolved"), DB::raw('SUBSTR(patients.gender,1,1) as gender'))
            ->where('tb_mac_forms.form_type', 'enrollment')
            ->whereIn('tb_mac_forms.status', ['Enrolled', 'Not Enrolled', 'New Enrollment'])
            ->whereBetween('tb_mac_forms.created_at', [$firstDay, $lastDay])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        return response([
            'enrollment' => $enrollment,
            'treatment_outcome' => $treatmentOutcome,
            'case_management' => $caseManagement,
        ]);
    }

    public function filter()
    {
        $request = request()->all();
        $firstDay = Carbon::now()->firstOfMonth()->format('Y-m-d');
        $lastDay = Carbon::now()->lastOfMonth()->format('Y-m-d');
        $caseManagement = DB::table('tb_mac_forms')
            ->leftJoin('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('case_management_regiment_form', 'case_management_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', DB::raw('"case_management" as form_type'), DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'New Case' THEN tb_mac_forms.status ELSE null END) as status"), 'case_management_regiment_form.sec_remarks as remarks', DB::raw('concat("C-",tb_mac_forms.presentation_number) as presentation_number'), DB::raw('(CASE WHEN recommendation.status = "Approved" then recommendation.status WHEN recommendation.status = "Other suggestions" then recommendation.status WHEN recommendation.status = "Need Further Details" then recommendation.status WHEN recommendation.status = "Referred to Regional" then recommendation.status else null END) as recommendation'), DB::raw('SUBSTR(patients.first_name, 0, 1) as patients_fname '), DB::raw('SUBSTR(patients.middle_name, 1, 1) as patients_mname'), DB::raw('SUBSTR(patients.last_name, 1, 1) as patients_lname'), DB::raw('TIMESTAMPDIFF(YEAR, patients.birthday,CURDATE()) as age'), DB::raw("(CASE  WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.updated_at WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.updated_at ELSE null END) as date_resolved"), DB::raw('SUBSTR(patients.gender,1,1) as gender'))
            ->where('tb_mac_forms.form_type', 'case_management')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved', 'New Case'])
            ->whereBetween('tb_mac_forms.created_at', [date('Y-m-d', ! isset($request['date_from']) ? strtotime($firstDay) : strtotime($request['date_from'])), date('Y-m-d', ! isset($request['date_to']) ? strtotime($lastDay) : strtotime($request['date_to']))])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $treatmentOutcome = DB::table('tb_mac_forms')
            ->leftJoin('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->join('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->join('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->join('treatment_outcome_form', 'treatment_outcome_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', DB::raw('"treatment_outcome" as form_type'), DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'New Case' THEN tb_mac_forms.status ELSE null END) as status"), 'treatment_outcome_form.sec_remarks as remarks',
                DB::raw('concat("T-",tb_mac_forms.presentation_number) as presentation_number'),
                DB::raw('(CASE WHEN recommendation.status = "Approved" then recommendation.status WHEN recommendation.status = "Other suggestions" then recommendation.status WHEN recommendation.status = "Need Further Details" then recommendation.status WHEN recommendation.status = "Referred to Regional" then recommendation.status else null END) as recommendation'), DB::raw('SUBSTR(patients.first_name, 0, 1) as patients_fname '), DB::raw('SUBSTR(patients.middle_name, 1, 1) as patients_mname'),
                DB::raw('SUBSTR(patients.last_name, 1, 1) as patients_lname'),
                DB::raw('TIMESTAMPDIFF(YEAR, patients.birthday,CURDATE()) as age'),
                DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.updated_at WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.updated_at ELSE null END) as date_resolved"),
                DB::raw('SUBSTR(patients.gender,1,1) as gender'))
            ->where('tb_mac_forms.form_type', 'treatment_outcome')
            ->whereIn('tb_mac_forms.status', ['Resolved', 'Not Resolved', 'New Case'])
            ->whereBetween('tb_mac_forms.created_at', [date('Y-m-d', ! isset($request['date_from']) ? strtotime($firstDay) : strtotime($request['date_from'])), date('Y-m-d', ! isset($request['date_to']) ? strtotime($lastDay) : strtotime($request['date_to']))])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        $enrollment = DB::table('tb_mac_forms')
            ->leftJoin('recommendation', 'tb_mac_forms.id', 'recommendation.form_id')
            ->leftJoin('patients', 'patients.id', 'tb_mac_forms.patient_id')
            ->leftJoin('laboratory_results', 'laboratory_results.form_id', 'tb_mac_forms.id')
            ->leftJoin('enrollment_regiment_form', 'enrollment_regiment_form.form_id', 'tb_mac_forms.id')
            ->select('tb_mac_forms.id', DB::raw('"enrollment" as form_type'), DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Enrolled' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'Enrolled' THEN tb_mac_forms.status WHEN tb_mac_forms.status = 'New Enrollment' THEN tb_mac_forms.status ELSE null END) as status"), 'enrollment_regiment_form.sec_remarks as remarks', DB::raw('concat("E-",tb_mac_forms.presentation_number) as presentation_number'), DB::raw('(CASE WHEN recommendation.status = "For enrollment" then recommendation.status WHEN recommendation.status = "Not for Enrollment" then recommendation.status WHEN recommendation.status = "Need Further Details" then recommendation.status WHEN recommendation.status = "Referred to national" then recommendation.status else null END) as recommendation'), DB::raw('SUBSTR(patients.first_name, 1, 1) as patients_fname '), DB::raw('SUBSTR(patients.middle_name, 1, 1) as patients_mname'), DB::raw('SUBSTR(patients.last_name, 1, 1) as patients_lname'), DB::raw('TIMESTAMPDIFF(YEAR, patients.birthday,CURDATE()) as age'), DB::raw("(CASE WHEN tb_mac_forms.status = 'Not Resolved' THEN tb_mac_forms.updated_at WHEN tb_mac_forms.status = 'Resolved' THEN tb_mac_forms.updated_at ELSE null END) as date_resolved"), DB::raw('SUBSTR(patients.gender,1,1) as gender'))
            ->where('tb_mac_forms.form_type', 'enrollment')
            ->whereIn('tb_mac_forms.status', ['Enrolled', 'Not Enrolled', 'New Enrollment'])
            ->whereBetween('tb_mac_forms.created_at', [date('Y-m-d', ! isset($request['date_from']) ? strtotime($firstDay) : strtotime($request['date_from'])), date('Y-m-d', ! isset($request['date_to']) ? strtotime($lastDay) : strtotime($request['date_to']))])
            ->orderByDesc('tb_mac_forms.id')
            ->get();
        return response([
            'enrollment' => $enrollment,
            'treatment_outcome' => $treatmentOutcome,
            'case_management' => $caseManagement,
        ]);
    }

    public function updateRemarks($id)
    {
        $request = request()->all();
        if ($request['form_type'] === 'enrollment') {
            EnrollmentRegimentForm::where('form_id', $id)->update([
                'sec_remarks' => $request['remarks'],
            ]);
        }

        if ($request['form_type'] === 'case_management') {
            CaseManagementRegimentForm::where('form_id', $id)->update([
                'sec_remarks' => $request['remarks'],
            ]);
        }

        if ($request['form_type'] === 'treatment_outcome') {
            TreatmentOutcomeForm::where('form_id', $id)->update([
                'sec_remarks' => $request['remarks'],
            ]);
        }

        return response()->json('Remarks send successfully');
    }
}
