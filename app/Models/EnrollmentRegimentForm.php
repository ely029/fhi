<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnrollmentRegimentForm
 *
 * @property int $id
 * @property int $form_id
 * @property string|null $treatment_history
 * @property string|null $registration_group
 * @property string|null $risk_factor
 * @property string|null $drug_susceptibility
 * @property string|null $current_weight
 * @property string|null $suggested_regimen
 * @property string|null $regimen_notes
 * @property string|null $clinical_status
 * @property string|null $signs_and_symptoms
 * @property string|null $vital_signs
 * @property string|null $diag_and_lab_findings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EnrollmentRegimentFormFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereClinicalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereCurrentWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereDiagAndLabFindings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereDrugSusceptibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereRegimenNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereRegistrationGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereRiskFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereSignsAndSymptoms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereSuggestedRegimen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereTreatmentHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnrollmentRegimentForm whereVitalSigns($value)
 * @mixin \Eloquent
 */
class EnrollmentRegimentForm extends Model
{
    use HasFactory;

    protected $table = 'enrollment_regiment_form';
    protected $fillable = [
        'treatment_history',
        'registration_group',
        'risk_factor',
        'drug_susceptibility',
        'current_weight',
        'suggested_regimen',
        'regimen_notes','clinical_status','signs_and_symptoms','vital_signs',
        'diag_and_lab_findings',
    ];
}
